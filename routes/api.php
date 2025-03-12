<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsuariosController;

Route::get('/usuarios', [UsuariosController::class, 'index']);

Route::get('/usuarios/{id}',[UsuariosController::class, 'show']);

Route::post('/usuarios', [UsuariosController::class,'store']);

Route::put('/usuarios/{id}', [UsuariosController::class,'update']);

Route::patch('/usuarios/{id}', [UsuariosController::class,'updatePartial']);

Route::delete('/usuarios/{id}',[UsuariosController::class,'destroy']);

