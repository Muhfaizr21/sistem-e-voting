<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin.access');
    }

    public function dashboard()
    {
        $totalUsers = User::count();
        $totalVotes = Vote::count();
        $candidates = Candidate::withCount('votes')->get();

        return view('admin.dashboard', compact('totalUsers', 'totalVotes', 'candidates'));
    }

    public function manageCandidates()
    {
        $candidates = Candidate::all();
        return view('admin.candidates', compact('candidates'));
    }

    public function storeCandidate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:50',
            'vision' => 'required|string',
            'mission' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('candidates', 'public');
        }

        Candidate::create([
            'name' => $request->name,
            'class' => $request->class,
            'vision' => $request->vision,
            'mission' => $request->mission,
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.candidates')->with('success', 'Kandidat berhasil ditambahkan!');
    }

    public function deleteCandidate($id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->delete();

        return redirect()->route('admin.candidates')->with('success', 'Kandidat berhasil dihapus!');
    }
}
