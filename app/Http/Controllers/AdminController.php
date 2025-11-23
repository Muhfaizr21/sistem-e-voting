<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Check if user is admin
     */
    private function isAdmin()
    {
        return Auth::check() && Auth::user()->email === 'admin@pilketos.id';
    }

    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login')->with('error', '🔐 Akses admin ditolak!');
        }

        try {
            $totalUsers = User::count();
            $totalVotes = Vote::count();
            $candidates = Candidate::withCount('votes')
                ->orderBy('votes_count', 'desc')
                ->get();

            $participationRate = $totalUsers > 0 ? round(($totalVotes / $totalUsers) * 100, 1) : 0;

            return view('admin.dashboard', compact(
                'totalUsers',
                'totalVotes',
                'candidates',
                'participationRate'
            ));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Error loading dashboard: ' . $e->getMessage());
        }
    }

    /**
     * Show candidate management page
     */
    public function manageCandidates()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login')->with('error', '🔐 Akses admin ditolak!');
        }

        try {
            $candidates = Candidate::orderBy('created_at', 'desc')->get();
            return view('admin.candidates', compact('candidates'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Error loading candidates: ' . $e->getMessage());
        }
    }

    /**
     * Store new candidate
     */
    public function storeCandidate(Request $request)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login')->with('error', '🔐 Akses admin ditolak!');
        }

        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:3',
            'class' => 'required|string|max:50|min:2',
            'vision' => 'required|string|min:10|max:1000',
            'mission' => 'required|string|min:10|max:2000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120' // 5MB max
        ], [
            'name.required' => 'Nama kandidat wajib diisi',
            'name.min' => 'Nama kandidat minimal 3 karakter',
            'class.required' => 'Kelas wajib diisi',
            'vision.required' => 'Visi wajib diisi',
            'vision.min' => 'Visi minimal 10 karakter',
            'mission.required' => 'Misi wajib diisi',
            'mission.min' => 'Misi minimal 10 karakter',
            'photo.image' => 'File harus berupa gambar',
            'photo.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau GIF',
            'photo.max' => 'Ukuran gambar maksimal 5MB'
        ]);

        try {
            // Handle photo upload
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $filename = 'candidate-' . Str::slug($validated['name']) . '-' . time() . '.' . $file->getClientOriginalExtension();
                $photoPath = $file->storeAs('candidates', $filename, 'public');
            }

            // Create candidate
            Candidate::create([
                'name' => trim($validated['name']),
                'class' => trim($validated['class']),
                'vision' => trim($validated['vision']),
                'mission' => trim($validated['mission']),
                'photo' => $photoPath,
                'vote_count' => 0
            ]);

            return redirect()
                ->route('admin.candidates')
                ->with('success', '✅ Kandidat ' . $validated['name'] . ' berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', '❌ Gagal menambahkan kandidat: ' . $e->getMessage());
        }
    }

    /**
     * Delete candidate
     */
    public function deleteCandidate($id)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login')->with('error', '🔐 Akses admin ditolak!');
        }

        try {
            $candidate = Candidate::findOrFail($id);

            // Delete photo if exists
            if ($candidate->photo && Storage::disk('public')->exists($candidate->photo)) {
                Storage::disk('public')->delete($candidate->photo);
            }

            $candidateName = $candidate->name;
            $candidate->delete();

            return redirect()
                ->route('admin.candidates')
                ->with('success', '🗑️ Kandidat ' . $candidateName . ' berhasil dihapus!');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()
                ->route('admin.candidates')
                ->with('error', '❌ Kandidat tidak ditemukan!');

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.candidates')
                ->with('error', '❌ Gagal menghapus kandidat: ' . $e->getMessage());
        }
    }

    /**
     * Show candidate edit form
     */
    public function editCandidate($id)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login')->with('error', '🔐 Akses admin ditolak!');
        }

        try {
            $candidate = Candidate::findOrFail($id);
            return view('admin.candidate-edit', compact('candidate'));

        } catch (\Exception $e) {
            return redirect()
                ->route('admin.candidates')
                ->with('error', '❌ Kandidat tidak ditemukan!');
        }
    }

    /**
     * Update candidate
     */
    public function updateCandidate(Request $request, $id)
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login')->with('error', '🔐 Akses admin ditolak!');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|min:3',
            'class' => 'required|string|max:50|min:2',
            'vision' => 'required|string|min:10|max:1000',
            'mission' => 'required|string|min:10|max:2000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'remove_photo' => 'nullable|boolean'
        ]);

        try {
            $candidate = Candidate::findOrFail($id);

            // Handle photo removal
            if ($request->has('remove_photo') && $candidate->photo) {
                if (Storage::disk('public')->exists($candidate->photo)) {
                    Storage::disk('public')->delete($candidate->photo);
                }
                $validated['photo'] = null;
            }

            // Handle new photo upload
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($candidate->photo && Storage::disk('public')->exists($candidate->photo)) {
                    Storage::disk('public')->delete($candidate->photo);
                }

                // Upload new photo
                $file = $request->file('photo');
                $filename = 'candidate-' . Str::slug($validated['name']) . '-' . time() . '.' . $file->getClientOriginalExtension();
                $photoPath = $file->storeAs('candidates', $filename, 'public');
                $validated['photo'] = $photoPath;
            }

            $candidate->update([
                'name' => trim($validated['name']),
                'class' => trim($validated['class']),
                'vision' => trim($validated['vision']),
                'mission' => trim($validated['mission']),
                'photo' => $validated['photo'] ?? $candidate->photo
            ]);

            return redirect()
                ->route('admin.candidates')
                ->with('success', '✏️ Kandidat ' . $validated['name'] . ' berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', '❌ Gagal memperbarui kandidat: ' . $e->getMessage());
        }
    }

    /**
     * Show detailed voting results
     */
    public function votingResults()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login')->with('error', '🔐 Akses admin ditolak!');
        }

        try {
            $totalUsers = User::count();
            $totalVotes = Vote::count();
            $candidates = Candidate::withCount('votes')
                ->orderBy('vote_count', 'desc')
                ->get();

            $participationRate = $totalUsers > 0 ? round(($totalVotes / $totalUsers) * 100, 1) : 0;

            // Calculate percentages
            $percentages = [];
            $totalVotesCount = $candidates->sum('vote_count');

            foreach ($candidates as $candidate) {
                $percentage = $totalVotesCount > 0 ? round(($candidate->vote_count / $totalVotesCount) * 100, 1) : 0;
                $percentages[$candidate->id] = $percentage;
            }

            // Get leading candidate
            $leadingCandidate = $candidates->first();
            $leadingPercentage = $leadingCandidate ? $percentages[$leadingCandidate->id] : 0;

            // Get recent votes
            $recentVotes = Vote::with(['user', 'candidate'])
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();

            // Get all votes for timeline
            $votes = Vote::orderBy('created_at')->get();

            return view('admin.voting-results', compact(
                'totalUsers',
                'totalVotes',
                'candidates',
                'participationRate',
                'percentages',
                'leadingCandidate',
                'leadingPercentage',
                'recentVotes',
                'votes'
            ));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Error loading voting results: ' . $e->getMessage());
        }
    }

    /**
     * Show user management page (bonus feature)
     */
    public function manageUsers()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login')->with('error', '🔐 Akses admin ditolak!');
        }

        try {
            $users = User::with('vote')->orderBy('created_at', 'desc')->get();
            return view('admin.users', compact('users'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Error loading users: ' . $e->getMessage());
        }
    }

    /**
     * Reset voting (bonus feature - hati-hati!)
     */
    public function resetVoting()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login')->with('error', '🔐 Akses admin ditolak!');
        }

        try {
            // Reset all votes
            Vote::truncate();

            // Reset candidate vote counts
            Candidate::query()->update(['vote_count' => 0]);

            // Reset user voting status
            User::query()->update(['has_voted' => false]);

            return redirect()
                ->route('admin.dashboard')
                ->with('success', '🔄 Semua data voting berhasil direset!');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', '❌ Gagal reset voting: ' . $e->getMessage());
        }
    }

    /**
     * Export data (bonus feature)
     */
    public function exportData()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('login')->with('error', '🔐 Akses admin ditolak!');
        }

        try {
            $candidates = Candidate::withCount('votes')->get();
            $votes = Vote::with(['user', 'candidate'])->get();

            $data = [
                'candidates' => $candidates,
                'votes' => $votes,
                'exported_at' => now()->toDateTimeString(),
                'total_users' => User::count(),
                'total_votes' => Vote::count()
            ];

            // In a real application, you would generate CSV or Excel file here
            return response()->json($data);

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', '❌ Gagal export data: ' . $e->getMessage());
        }
    }
}
