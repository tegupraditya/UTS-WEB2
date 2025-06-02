<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\SkillOfferController;
use App\Http\Controllers\MatchingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController; // Import AuthController yang baru dibuat
use App\Http\Controllers\TransactionController; // Import TransactionController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rute untuk Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');


Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::get('/login', [AuthController::class, 'login'])->name('login'); // Nama 'login' penting untuk middleware auth
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::delete('/logout', [AuthController::class, 'logout'])->name('auth.logout'); // Menggunakan DELETE untuk logout


// Grup Rute yang Memerlukan Autentikasi
Route::middleware('auth')->group(function () {
    // Route Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Route Skill Offers
    Route::resource('skill-offers', SkillOfferController::class);

    // --- User Profile Routes ---
    // Untuk pengguna mengelola profilnya sendiri (membuat atau mengedit)
    Route::get('/my-profile/create', [UserProfileController::class, 'create'])->name('user-profiles.create.mine');
    Route::post('/my-profile', [UserProfileController::class, 'store'])->name('user-profiles.store.mine');
    Route::get('/my-profile/edit', [UserProfileController::class, 'edit'])->name('user-profiles.edit.mine');
    Route::put('/my-profile', [UserProfileController::class, 'update'])->name('user-profiles.update.mine');

    // Rute untuk menampilkan daftar semua profil pengguna (jika ada fitur ini)
    Route::get('/user-profiles', [UserProfileController::class, 'index'])->name('user-profiles.index');

    // Rute untuk menampilkan detail profil pengguna tertentu (bisa profil sendiri atau orang lain)
    // Menggunakan {userProfile} sebagai parameter untuk Route Model Binding
    Route::get('/user-profiles/{userProfile}', [UserProfileController::class, 'show'])->name('user-profiles.show');
    
    // Rute untuk menghapus profil (jika diperlukan dan dengan otorisasi yang tepat)
    // Route::delete('/user-profiles/{userProfile}', [UserProfileController::class, 'destroy'])->name('user-profiles.destroy');


    // Route Categories
    Route::resource('categories', CategoryController::class);

    // Route Matching
    Route::prefix('matching')->name('matching.')->group(function () {
        Route::get('/', [MatchingController::class, 'index'])->name('index');
        Route::get('/{id}', [MatchingController::class, 'show'])->name('show'); 
    });

    // --- Transaction Routes ---
    // Menampilkan daftar transaksi milik pengguna yang login
    Route::get('/my-transactions', [TransactionController::class, 'index'])->name('transactions.index.mine');

    // Membuat proposal transaksi pada sebuah SkillOffer
    // {skillOffer} akan menjadi parameter untuk method storeProposal
    Route::post('/skill-offers/{skillOffer}/propose-transaction', [TransactionController::class, 'storeProposal'])->name('transactions.store.proposal');

    // Menampilkan detail sebuah transaksi
    // {transaction} akan di-resolve oleh Route Model Binding
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');

    // Mengupdate status sebuah transaksi
    Route::patch('/transactions/{transaction}/status', [TransactionController::class, 'updateStatus'])->name('transactions.update.status');
    // Atau bisa juga PUT jika Anda prefer: Route::put(...)

    // Rute untuk membatalkan transaksi (contoh, bisa dibuat method khusus)
    // Route::patch('/transactions/{transaction}/cancel', [TransactionController::class, 'cancel'])->name('transactions.cancel');
});

// Komentar tentang auth.php tetap relevan jika Anda tidak menggunakan AuthController kustom sepenuhnya
// if (file_exists(__DIR__.'/auth.php')) {
//     require __DIR__.'/auth.php';
// }
