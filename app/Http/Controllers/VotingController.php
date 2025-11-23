<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VotingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show candidates page for voting
     */
    public function showCandidates()
    {
        // Cek manual jika sudah vote
        if (Auth::user()->has_voted) {
            return redirect()->route('voting.thanks');
        }

        try {
            $candidates = Candidate::all();
            return view('voting.candidates', compact('candidates'));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Error memuat kandidat: ' . $e->getMessage());
        }
    }

    /**
     * Process vote
     */
    public function vote(Request $request, $candidateId)
    {
        // Cek manual jika sudah vote
        if (Auth::user()->has_voted) {
            return redirect()->route('voting.thanks');
        }

        try {
            DB::beginTransaction();

            $candidate = Candidate::findOrFail($candidateId);

            // Record vote
            Vote::create([
                'user_id' => Auth::id(),
                'candidate_id' => $candidateId,
                'voted_at' => now()
            ]);

            // Update candidate vote count
            $candidate->increment('vote_count');

            // Mark user as voted
            Auth::user()->update(['has_voted' => true]);

            DB::commit();

            return redirect()->route('voting.thanks');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', '❌ Gagal melakukan voting: ' . $e->getMessage());
        }
    }

    /**
     * Show thank you page after voting
     */
    public function thanks()
    {
        $userVote = Vote::with('candidate')->where('user_id', Auth::id())->first();
        return view('voting.thanks', compact('userVote'));
    }

    /**
     * Show real-time results
     */
    public function results()
    {
        try {
            $candidates = Candidate::withCount('votes')
                ->orderBy('vote_count', 'desc')
                ->get();

            $totalVotes = Vote::count();
            $totalUsers = \App\Models\User::count();
            $participationRate = $totalUsers > 0 ? round(($totalVotes / $totalUsers) * 100, 1) : 0;

            // Calculate percentages
            $percentages = [];
            foreach ($candidates as $candidate) {
                $percentage = $totalVotes > 0 ? round(($candidate->vote_count / $totalVotes) * 100, 1) : 0;
                $percentages[$candidate->id] = $percentage;
            }

            $userHasVoted = Auth::user()->has_voted;

            return view('voting.results', compact(
                'candidates',
                'totalVotes',
                'participationRate',
                'percentages',
                'userHasVoted'
            ));

        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Error memuat hasil: ' . $e->getMessage());
        }
    }

    /**
     * Show user profile
     */
    public function profile()
    {
        $user = Auth::user();
        $userVote = Vote::with('candidate')->where('user_id', $user->id)->first();

        return view('voting.profile', compact('user', 'userVote'));
    }

    /**
     * Show voting instructions
     */
    public function instructions()
    {
        return view('voting.instructions');
    }
}
