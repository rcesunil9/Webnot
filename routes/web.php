<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubadminController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\SuperAgentController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AjaxController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::any('/getUsersByType', [AjaxController::class, 'getUsersByType']);

    /*-------------------- All Super Admin Routes List--------------------*/    
    Route::middleware(['user-access'])->group(function () {
        Route::resource('inSubAdmin', SubadminController::class);
        Route::resource('inMasters', MasterController::class);
        Route::resource('inSuperAgent', SuperAgentController::class);
        Route::resource('inAgent', AgentController::class);
        Route::resource('inClient', ClientController::class);        
    });
});