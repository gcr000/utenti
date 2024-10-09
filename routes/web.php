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
    Route::resource('users', \App\Http\Controllers\UserController::class);
});

require __DIR__.'/auth.php';
