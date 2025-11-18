<?php

use App\Http\Controllers\DenunciasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.app');
});

Route::resource('denuncias', DenunciasController::class);
