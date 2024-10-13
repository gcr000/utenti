<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// TWO FACTOR AUTHENTICATION
Route::get('/2fa/verify', [ProfileController::class, 'showVerifyForm'])->name('2fa.verify');
Route::post('/2fa/verify', [ProfileController::class, 'verify'])->name('2fa.verify.post');

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // PROFILO UTENTE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/user/two-factor-authentication', [ProfileController::class, 'manageTwoFactorAuthentication'])->name('two-factor.enable');
    Route::get('set_locale/{locale}', [ProfileController::class, 'setLocale'])->name('set_locale');

    // UTENTI
    Route::patch('custom_update/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.custom_update');
    Route::put('password_update/{id}', [\App\Http\Controllers\UserController::class, 'password_update'])->name('users.password_update');
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::post('users_search', [\App\Http\Controllers\UserController::class, 'search'])->name('users.search');
    Route::get('users/two_factor_disabled/{id}', [\App\Http\Controllers\UserController::class, 'two_factor_disabled'])->name('users.two_factor_disabled');
});

require __DIR__.'/auth.php';
