<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\SkillOfferController;
use App\Http\Controllers\MatchingController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

// Route Dashboard (langsung ke controller Dashboard)
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

// Route Skill Offers
Route::resource('skill-offers', SkillOfferController::class);

// Route::put('userprofile/{userprofile}', [UserProfileController::class, 'update'])->name('userprofile.update');

// Route User Profile
Route::resource('user-profiles', UserProfileController::class);

// Route Matching
Route::prefix('matching')->name('matching.')->group(function () {
    Route::get('/', [MatchingController::class, 'index'])->name('index');
    Route::get('/{id}', [MatchingController::class, 'show'])->name('show');
});

