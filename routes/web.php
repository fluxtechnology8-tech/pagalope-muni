<?php

use App\Models\Contribuyente;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contribuyentes', [Contribuyente::class, 'index'])->name('contribuyentes.index');
Route::get('/contribuyentes/create', [Contribuyente::class, 'create'])->name('contribuyentes.create');
Route::post('/contribuyentes', [Contribuyente::class, 'store'])->name('contribuyentes.store');
Route::get('/contribuyentes/{id}', [Contribuyente::class, 'show'])->name('contribuyentes.show');
Route::get('/contribuyentes/{id}/edit', [Contribuyente::class, 'edit'])->name('contribuyentes.edit');
Route::put('/contribuyentes/{id}', [Contribuyente::class, 'update'])->name('contribuyentes.update');
Route::delete('/contribuyentes/{id}', [Contribuyente::class, 'destroy'])->name('contribuyentes.destroy');
