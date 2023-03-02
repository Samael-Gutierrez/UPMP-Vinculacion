<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\AsesoresAcademicosController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\AsesorIndustrialController;

Route::get('/', function () {
    return redirect()->route('empresas.index');
})->name('index')->middleware(['auth:root']);

Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:root');

Route::prefix('catalogos')->group(function (){

    Route::resource('empresas', EmpresasController::class)->except('show')->parameters(['empresas' => 'empresa'])->middleware('auth:root');
    Route::put('empresas/togglestatus/{empresa}', [EmpresasController::class, 'toggleStatus'])->name('empresas.toggle.status')->middleware(['auth:root']);

    Route::resource('asesores-industriales', AsesorIndustrialController::class)->except('show')->parameters(['asesores-industriales' => 'asesorIndustrial'])->middleware('auth:root');
    Route::put('asesores-industriales/togglestatus/{asesorIndustrial}', [AsesorIndustrialController::class, 'toggleStatus'])->name('asesores-industriales.toggle.status')->middleware(['auth:root']);

    Route::resource('asesores-academicos', AsesoresAcademicosController::class)->except('show')->parameters(['asesores-academicos' => 'asesorAcademico'])->middleware('auth:root');
    Route::put('asesores-academicos/togglestatus/{asesorAcademico}', [AsesoresAcademicosController::class, 'toggleStatus'])->name('asesores-academicos.toggle.status')->middleware(['auth:root']);
});

Route::prefix('reportes')->group(function (){

    Route::resource('solicitudes', SolicitudController::class)->except(['edit', 'show'])->middleware('auth:root')->parameters(['solicitudes' => 'solicitud']);
    Route::get('solicitudes/{id}', [SolicitudController::class, 'edit'])->middleware('auth:root')->name('solicitudes.edit');

});

Route::get('usuario/perfil', [AdminController::class, 'perfil'])->middleware('auth:root')->name('perfil');
Route::put('updatepassword/{id}', [AdminController::class, 'updatepassword'])->name('updatepassword');
Route::put('updatefoto/{id}', [AdminController::class, 'updatefoto'])->name('updatefoto');
