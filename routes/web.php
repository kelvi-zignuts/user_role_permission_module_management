<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;
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

// Main Page Route
Route::middleware('api')->group(function () use ($controller_path) {
    // Main Page Route
    Route::get('/', $controller_path . '\pages\HomePage@index')->name('pages-home');
    // Route::get('/modules', $controller_path . '\modules\ModuleController@index')->name('modules-index');
    

    // pages
    Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');

    // authentication
    Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
    Route::post('/auth/login-basic', $controller_path . '\authentications\LoginBasic@login')->name('login');
    Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');

    Route::get('/modules', [ModuleController::class, 'index'])->name('modules-index');
    Route::get('/modules/edit/{code}', [ModuleController::class, 'edit'])->name('modules.edit');
    Route::put('/modules/{code}', [ModuleController::class, 'update'])->name('modules.update');
    Route::post('/modules/{code}/toggle-active', [ModuleController::class, 'toggleActive'])->name('modules.toggleActive');
    // Route::put('/modules/{moduleId}', [ModuleController::class, 'update'])->name('modules.update');


});

    // Route::get('/', $controller_path . '\pages\HomePage@index')->name('pages-home')->middleware('api');
    
    // Route::get('/page-2', $controller_path . '\pages\Page2@index')->name('pages-page-2');
    // Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');
    
    // // authentication
    
    // // Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
    // Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
    // Route::post('/auth/login-basic', $controller_path . '\authentications\LoginBasic@login')->name('login');
    // Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');