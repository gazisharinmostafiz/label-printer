<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
   
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('dashboard'); 
    // Product Resource Routes
    Route::resource('products', AdminProductController::class);
});
// END OF ADMIN ROUTES SECTION

require __DIR__.'/auth.php';
