<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PermissionController;
// use App\Http\Controllers\pages\HomePage;
// use App\Http\Controllers\authentications\LoginBasic;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$controller_path = 'App\Http\Controllers';

// authentication
Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::post('/auth/login-basic', $controller_path . '\authentications\LoginBasic@login')->name('login');
// Route::get('/auth/login-basic', [LoginBasicController::class, 'index'])->name('auth-login-form');

// Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');

// Main Page Route
Route::middleware('auth')->group(function () use ($controller_path) {
    // Main Page Route
    Route::get('/', $controller_path . '\pages\HomePage@index')->name('pages-home');
    // Route::get('/modules', $controller_path . '\modules\ModuleController@index')->name('modules-index');
    

    // pages
    Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');

    Route::prefix('modules')->group(function () {
        Route::get('/', [ModuleController::class, 'index'])->name('modules-index');
        Route::get('/edit/{code}', [ModuleController::class, 'edit'])->name('modules.edit');
        Route::post('modules/{code}', [ModuleController::class, 'update'])->name('modules.update');
        Route::post('/{code}/toggle-active', [ModuleController::class, 'toggleActive'])->name('modules.toggleActive');
    });

    // Route::get('/modules', [ModuleController::class, 'index'])->name('modules-index');
    // Route::get('/modules/edit/{code}', [ModuleController::class, 'edit'])->name('modules.edit');
    // Route::put('/modules/{code}', [ModuleController::class, 'update'])->name('modules.update');
    // Route::post('/modules/{code}/toggle-active', [ModuleController::class, 'toggleActive'])->name('modules.toggleActive');
    // Route::put('/modules/{moduleId}', [ModuleController::class, 'update'])->name('modules.update');
    Route::prefix('permissions')->group(function () {
      
        Route::get('/', [PermissionController::class, 'index'])->name('permissions-index');
        Route::get('/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/store', [PermissionController::class, 'store'])->name('permissions.store');
        // Route::post('/{id}/toggle-active', [ModuleController::class, 'toggleActive'])->name('permissions.toggleActive');
        Route::post('/{id}/toggle-active', [PermissionController::class, 'toggleActive'])->name('permissions.toggleActive');
        // Route::put('/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::post('/{permission}/update', [PermissionController::class, 'update'])->name('permissions.update');

        Route::post('/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');


    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles-index');
        Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
        // Route::post('/{id}/toggle-active', [RoleController::class, 'toggleActive'])->name('role.toggleActive');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::post('/{role}/update', [RoleController::class, 'update'])->name('roles.update');


    });


});

    // Route::get('/', $controller_path . '\pages\HomePage@index')->name('pages-home')->middleware('api');
    
    // Route::get('/page-2', $controller_path . '\pages\Page2@index')->name('pages-page-2');
    // Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');
    
    // // authentication
    
    // // Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
    // Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
    // Route::post('/auth/login-basic', $controller_path . '\authentications\LoginBasic@login')->name('login');
    // Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');