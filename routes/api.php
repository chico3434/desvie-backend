<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/usuarios', UsuarioController::class);

Route::post('/login', [UsuarioController::class, 'login'])->name('usuario.login');
