<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContribuyenteController;
use App\Http\Controllers\Admin\DeudaController;
use App\Http\Controllers\Admin\PagoController;
use App\Http\Controllers\Admin\RolController;
use App\Http\Controllers\Admin\ModuloController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\ReporteController;
use App\Http\Controllers\Admin\AuditoriaController;
use App\Http\Controllers\Admin\AccesoController;

/*
|--------------------------------------------------------------------------
| Rutas del Portal Público
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('portal.index');
Route::get('/pago', [HomeController::class, 'pago'])->name('portal.pago');
Route::get('/fraccionamiento', [HomeController::class, 'fraccionamiento'])->name('portal.fraccionamiento');
Route::get('/ayuda', [HomeController::class, 'ayuda'])->name('portal.ayuda');

/*
|--------------------------------------------------------------------------
| Rutas API públicas (consultas del portal)
|--------------------------------------------------------------------------
*/

// TODO: Registrar rutas API para:
//   GET /api/contribuyentes/buscar?doc=...  -> busca contribuyente por DNI/RUC
//   GET /api/stats                          -> estadísticas públicas
//   GET /api/contribuyentes                 -> listado (para admin)

/*
|--------------------------------------------------------------------------
| Autenticación Administrativa
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Panel Administrativo (requiere autenticación)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // TODO: Agregar middleware de autenticación y verificación de rol admin
    // ->middleware(['auth', 'admin'])

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Contribuyentes
    Route::resource('contribuyentes', ContribuyenteController::class);

    // Deudas
    Route::resource('deudas', DeudaController::class);

    // Pagos
    Route::get('pagos', [PagoController::class, 'index'])->name('pagos.index');
    Route::get('pagos/{id}', [PagoController::class, 'show'])->name('pagos.show');
    Route::get('pagos/{id}/comprobante', [PagoController::class, 'comprobante'])->name('pagos.comprobante');

    // Roles y permisos
    Route::resource('roles', RolController::class);

    // Módulos del sistema
    Route::resource('modulos', ModuloController::class);
    Route::patch('modulos/{id}/toggle', [ModuloController::class, 'toggle'])->name('modulos.toggle');

    // Usuarios admin
    Route::resource('usuarios', UsuarioController::class);

    // Reportes
    Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('reportes/recaudacion-mensual', [ReporteController::class, 'recaudacionMensual'])->name('reportes.recaudacion');
    Route::get('reportes/deudas-por-vencer', [ReporteController::class, 'deudasPorVencer'])->name('reportes.vencimiento');
    Route::get('reportes/contribuyentes-con-deuda', [ReporteController::class, 'contribuyentesConDeuda'])->name('reportes.morosos');

    // Auditoría
    Route::get('auditoria', [AuditoriaController::class, 'index'])->name('auditoria.index');
    Route::get('auditoria/{id}', [AuditoriaController::class, 'show'])->name('auditoria.show');

    // Log de accesos
    Route::get('accesos', [AccesoController::class, 'index'])->name('accesos.index');
});
