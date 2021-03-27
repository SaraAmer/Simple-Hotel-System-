<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagersController;
use App\Http\Controllers\ReceptionistsController;

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
Route::get('/admin', function () {
    return view('Admin/adminStartPage');
});

Auth::routes();
//Admin ONLY can....................................................
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/managers', [ManagersController::class, 'index'])->name('managers.index');
Route::post('/managers', [ManagersController::class, 'store'])->name('managers.store');

Route::get('/managers/create', [ManagersController::class, 'create'])->name('managers.create');

Route::get('/managers/{manager}/edit', [ManagersController::class, 'edit'])->name('managers.edit');

Route::put('/managers/{manager}', [ManagersController::class, 'update'])->name('managers.update');

Route::delete('/managers/{manager}', [ManagersController::class, 'destroy'])->name('managers.destroy');

//Admin OR manager can........................

Route::get('/receptionists', [ReceptionistsController::class, 'index'])->name('receptionists.index');
Route::post('/receptionists', [ReceptionistsController::class, 'store'])->name('receptionists.store');

Route::get('/receptionists/create', [ReceptionistsController::class, 'create'])->name('receptionists.create');

Route::get('/receptionists/{receptionist}/edit', [ReceptionistsController::class, 'edit'])->name('receptionists.edit');

Route::put('/receptionists/{receptionist}', [ReceptionistsController::class, 'update'])->name('receptionists.update');

Route::delete('/receptionists/{receptionist}', [ReceptionistsController::class, 'destroy'])->name('receptionists.destroy');




//Client
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/client', [App\Http\Controllers\ClientController::class, 'index'])->name('client');
Route::get('/client/home', [App\Http\Controllers\ClientController::class, 'home'])->name('clientHome');
Route::get('/client/reservation', [App\Http\Controllers\ClientController::class, 'reserve'])->name('clientReservation');
Route::get('/client/invoice', [App\Http\Controllers\ClientController::class, 'viewInvoices'])->name('clientInvoice');
