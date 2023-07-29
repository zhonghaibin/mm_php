<?php

use App\Http\Controllers\Home\HomeController;

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
