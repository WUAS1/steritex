<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FallaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportesController;

/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
*/

// Ruta principal - redirigir según autenticación
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->isAdministrador() 
            ? redirect()->route('dashboard') 
            : redirect()->route('fallas.index');
    }
    return redirect()->route('login');
})->name('home');

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Ruta pública de registro de fallas (accesible sin login para operadores)
// NOTA: En producción, probablemente quieras proteger esto también

// Rutas autenticadas - Fallos (Operador y Administrador)
Route::middleware(['auth'])->group(function () {
    // Estas rutas son accesibles para ambos roles
    Route::get('/fallas', [FallaController::class, 'index'])->name('fallas.index');
    Route::post('/fallas', [FallaController::class, 'store'])->name('fallas.store');
});

// Rutas de Administrador (protegidas por middleware de roles)
Route::middleware(['auth', 'role:administrador'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Reportes
    Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/filtro/{tipo}', [ReportesController::class, 'filtroRapido'])->name('reportes.filtro');
    Route::get('/reportes/export', [ReportesController::class, 'export'])->name('reportes.export');
});

// Exportación de reportes (accesible para todos los usuarios autenticados)
Route::middleware(['auth'])->group(function () {
    Route::get('/reportes/export/excel', [ReportesController::class, 'exportExcel'])->name('reportes.export.excel');
    Route::get('/reportes/export/pdf', [ReportesController::class, 'exportPdf'])->name('reportes.export.pdf');
});

