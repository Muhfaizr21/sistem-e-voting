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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Voting routes
    Route::get('/candidates', [VotingController::class, 'showCandidates'])->name('voting.candidates');
    Route::post('/vote/{candidate}', [VotingController::class, 'vote'])->name('voting.vote');
    Route::get('/thanks', [VotingController::class, 'thanks'])->name('voting.thanks');
});

// Admin routes
Route::middleware(['auth', 'admin.access'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/candidates', [AdminController::class, 'manageCandidates'])->name('admin.candidates');
    Route::post('/candidates', [AdminController::class, 'storeCandidate'])->name('admin.candidates.store');
    Route::delete('/candidates/{id}', [AdminController::class, 'deleteCandidate'])->name('admin.candidates.delete');
});

require __DIR__.'/auth.php';
