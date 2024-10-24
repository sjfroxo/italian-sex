<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainPageController::class, 'index'])->name('welcome');

Route::middleware(['auth', 'can:accessAdminPanel'])->group(function () {
    Route::get('/admin', [IndexController::class, 'index'])->name('main.index');
});

Route::middleware('web')->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::view('/login', 'auth.login')->name('login');
});

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/{slug}', [CategoryController::class, 'show'])->name('category.show');
    Route::post('/', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/{slug}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::patch('/{slug}', [CategoryController::class, 'update'])->name('category.update');
});

Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/{slug}', [ProductController::class, 'show'])->name('product.show');
    Route::post('/', [ProductController::class, 'store'])->name('product.store');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/{slug}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::patch('/{slug}', [ProductController::class, 'update'])->name('product.update');
});

Route::middleware(['auth'])->prefix('chat')->group(function () {
    Route::get('/', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/{id}/messages', [ChatController::class, 'getMessages']);
    Route::post('/send', [ChatController::class, 'sendMessage']);
});
