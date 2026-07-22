<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/export-csv', [DashboardController::class, 'exportCsv'])->name('dashboard.export');
    Route::patch('/dashboard/product/{id}/stock', [DashboardController::class, 'updateStock'])->name('dashboard.updateStock');
});

Route::middleware(['auth'])->group(function () {
    // Admin & Kasir routes
    Route::middleware(['role:admin,kasir'])->group(function () {
        Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
        Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
        Route::get('/inventory/{id}/edit', [InventoryController::class, 'edit']);
        Route::put('/inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update');
        Route::delete('/inventory/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
        Route::post('/inventory/{id}/restore', [InventoryController::class, 'restore'])->name('inventory.restore');
        Route::patch('/inventory/{id}/stock', [InventoryController::class, 'updateStock'])->name('inventory.updateStock');
    });

    // Kasir ONLY routes
    Route::middleware(['role:kasir'])->group(function () {
        Route::get('/cashier', [CashierController::class, 'index'])->name('cashier');
        Route::post('/cashier/transaction', [CashierController::class, 'processTransaction'])->name('cashier.transaction');
        Route::get('/cashier/product/{id}', [CashierController::class, 'getProduct']);
        Route::post('/cashier/transaction/{id}/print', [CashierController::class, 'logPrint'])->name('cashier.transaction.print');
    });

    // Profile routes (everyone)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';