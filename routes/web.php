<?php

use App\Http\Controllers\ContribuyenteController;
use App\Http\Controllers\DeudaController;
use App\Http\Controllers\ProfileController;
use App\Models\Deuda;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->prefix('contribuyentes')->group(function () {
    Route::get('/me', [ContribuyenteController::class, 'me'])->name('contribuyentes.me');
    Route::get('/create', [ContribuyenteController::class, 'create'])->name('contribuyentes.create');
    Route::post('', [ContribuyenteController::class, 'store'])->name('contribuyentes.store');
});

Route::middleware('auth')->prefix('deudas')->group(function () {
    Route::get('', [DeudaController::class, 'index'])->name('deudas.my');
});

require __DIR__.'/auth.php';
