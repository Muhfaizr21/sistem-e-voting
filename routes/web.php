<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VotingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES - Bisa diakses tanpa login
|--------------------------------------------------------------------------
*/

// 🔓 Halaman Welcome/Homepage
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 🔓 Hasil Pemilihan (bisa dilihat publik)
Route::get('/results', [VotingController::class, 'results'])->name('voting.results');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES - Dari Laravel Breeze (Authentication)
|--------------------------------------------------------------------------
*/

// 🔐 Dashboard user
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| USER ROUTES - Untuk user biasa yang sudah login & verified
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    // 👤 Profile Management (dari Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ========================
    // 🗳️ VOTING SYSTEM ROUTES
    // ========================

    // 📋 Daftar Kandidat untuk Voting
    Route::get('/candidates', [VotingController::class, 'showCandidates'])->name('voting.candidates');

    // ✅ Proses Voting
    Route::post('/vote/{candidate}', [VotingController::class, 'vote'])->name('voting.vote');

    // 🙏 Halaman Terima Kasih setelah Voting
    Route::get('/thanks', [VotingController::class, 'thanks'])->name('voting.thanks');

    // 👤 Profil User dengan riwayat voting
    Route::get('/my-profile', [VotingController::class, 'profile'])->name('voting.profile');

    // 📚 Panduan Voting
    Route::get('/instructions', [VotingController::class, 'instructions'])->name('voting.instructions');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES - Hanya untuk admin (manual check di controller)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // ========================
    // 📊 DASHBOARD & OVERVIEW
    // ========================

    // 🏠 Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // ========================
    // 👥 CANDIDATE MANAGEMENT
    // ========================

    // 📋 Kelola Kandidat
    Route::get('/candidates', [AdminController::class, 'manageCandidates'])->name('candidates');

    // ➕ Tambah Kandidat Baru
    Route::post('/candidates', [AdminController::class, 'storeCandidate'])->name('candidates.store');

    // ✏️ Form Edit Kandidat
    Route::get('/candidates/{id}/edit', [AdminController::class, 'editCandidate'])->name('candidates.edit');

    // 💾 Update Data Kandidat
    Route::put('/candidates/{id}', [AdminController::class, 'updateCandidate'])->name('candidates.update');

    // 🗑️ Hapus Kandidat
    Route::delete('/candidates/{id}', [AdminController::class, 'deleteCandidate'])->name('candidates.delete');

    // ========================
    // 📈 VOTING RESULTS & ANALYTICS
    // ========================

    // 📊 Hasil Voting Detail (Admin)
    Route::get('/voting-results', [AdminController::class, 'votingResults'])->name('voting.results');

    // ========================
    // 👥 USER MANAGEMENT
    // ========================

    // 👥 Kelola User
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('users');

    // ========================
    // ⚙️ SYSTEM MANAGEMENT
    // ========================

    // 🔄 Reset Semua Data Voting
    Route::post('/reset-voting', [AdminController::class, 'resetVoting'])->name('reset.voting');

    // 📥 Export Data (JSON/CSV)
    Route::get('/export-data', [AdminController::class, 'exportData'])->name('export.data');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES - Dari Laravel Breeze
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
