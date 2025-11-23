<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VotingController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/results', [VotingController::class, 'results'])->name('voting.results');

// Auth routes (from Breeze)
Route::get('/dashboard', function () {
    return redirect()->route('voting.candidates');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Voting routes dengan manual check
    Route::get('/candidates', [VotingController::class, 'showCandidates'])->name('voting.candidates');
    Route::post('/vote/{candidate}', [VotingController::class, 'vote'])->name('voting.vote');
    Route::get('/thanks', [VotingController::class, 'thanks'])->name('voting.thanks');
});

// Admin routes dengan manual check
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Candidate Management
    Route::get('/candidates', [AdminController::class, 'manageCandidates'])->name('admin.candidates');
    Route::post('/candidates', [AdminController::class, 'storeCandidate'])->name('admin.candidates.store');
    Route::get('/candidates/{id}/edit', [AdminController::class, 'editCandidate'])->name('admin.candidates.edit');
    Route::put('/candidates/{id}', [AdminController::class, 'updateCandidate'])->name('admin.candidates.update');
    Route::delete('/candidates/{id}', [AdminController::class, 'deleteCandidate'])->name('admin.candidates.delete');

    // Voting Results
    Route::get('/voting-results', [AdminController::class, 'votingResults'])->name('admin.voting.results');

    // User Management
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users');

    // System Management
    Route::post('/reset-voting', [AdminController::class, 'resetVoting'])->name('admin.reset.voting');
    Route::get('/export-data', [AdminController::class, 'exportData'])->name('admin.export.data');
});

require __DIR__.'/auth.php';
