<?php

use App\Http\Controllers\api\v1\GrupoController;
use App\Http\Controllers\api\v1\SolicitudController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\CarreraController;

Route::get('grupos', [GrupoController::class, 'index']);
Route::get('solicitudes', [SolicitudController::class, 'index']);
Route::get('carreras', [CarreraController::class, 'index']);
