<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('article/{id}', [HomeController::class, 'article'])->name('article');
Route::get('page/{id}', [HomeController::class, 'page'])->name('page');
Route::get('category/{id}', [HomeController::class, 'category'])->name('category');
Route::get('tag/{id}', [HomeController::class, 'tag'])->name('tag');
Route::get('search', [HomeController::class, 'search'])->name('search');
Route::get('archive', [HomeController::class, 'archive'])->name('archive');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
