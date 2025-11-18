<?php

use App\Http\Controllers\DenunciasController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DenunciasController::class, 'index']);

Route::get('denuncias', [DenunciasController::class, 'index'])->name('denuncias.index');
Route::get('denuncias/create', [DenunciasController::class, 'create'])->name('denuncias.create');
Route::get('denuncias/{denuncia}/edit', [DenunciasController::class, 'edit'])->name('denuncias.edit');
