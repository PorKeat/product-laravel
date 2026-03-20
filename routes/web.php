<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Public welcome page
Route::get('/', function () {
    return view('welcome');
});

// Protected dashboard (redirects here after login)
Route::get('/dashboard', function () {
    return redirect('/products'); // Redirect to products instead of dashboard
})->middleware(['auth', 'verified'])->name('dashboard');

// Protected product routes (require login)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('products', ProductController::class);
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication routes (login, register, etc.)
require __DIR__.'/auth.php';