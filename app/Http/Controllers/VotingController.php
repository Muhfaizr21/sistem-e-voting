<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VotingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('already.voted')->except(['thanks', 'results']);
    }

    public function showCandidates()
    {
        $candidates = Candidate::all();
        return view('voting.candidates', compact('candidates'));
    }

    public function vote(Request $request, $candidateId)
    {
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

        return redirect()->route('voting.thanks');
    }

    public function thanks()
    {
        return view('voting.thanks');
    }

    public function results()
    {
        $candidates = Candidate::orderBy('vote_count', 'desc')->get();
        return view('voting.results', compact('candidates'));
    }
}
