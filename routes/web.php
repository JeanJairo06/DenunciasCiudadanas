<?php

use App\Http\Controllers\DenunciasController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DenunciasController::class, 'index']);

Route::resource('denuncias', DenunciasController::class)->only([
    'index',
    'create',
    'edit',
]);
