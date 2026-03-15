<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminTransactionController;
use App\Http\Controllers\CustomerTransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('admin.transactions.index');
    Route::get('/transactions/{id}', [AdminTransactionController::class, 'show'])->name('admin.transactions.show');
});

Route::middleware(['auth', 'customer'])->prefix('customer')->group(function () {
    Route::get('/transactions', [CustomerTransactionController::class, 'index'])->name('customer.transactions.index');
    Route::get('/transactions/create', [CustomerTransactionController::class, 'create'])->name('customer.transactions.create');
    Route::post('/transactions', [CustomerTransactionController::class, 'store'])->name('customer.transactions.store');
    Route::get('/transactions/{id}', [CustomerTransactionController::class, 'show'])->name('customer.transactions.show');
});
