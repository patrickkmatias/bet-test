<?php

use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::controller(ProfileController::class)->group(function() {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::controller(AffiliateController::class)->group(function() {
        Route::get('/affiliates', 'index')->name('affiliate.index');
        Route::post('/affiliates', 'store')->name('affiliate.store');
        Route::patch('/affiliates/{affiliate}', 'update')->name('affiliate.update');
    });

    Route::resource('commissions', CommissionController::class)->only(['index', 'store', 'destroy']);
});

require __DIR__.'/auth.php';
