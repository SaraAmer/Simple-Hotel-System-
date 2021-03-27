<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/client', [App\Http\Controllers\ClientController::class, 'index'])->name('client');
Route::get('/client/home', [App\Http\Controllers\ClientController::class, 'home'])->name('clientHome');
Route::get('/client/reservation', [App\Http\Controllers\ClientController::class, 'reserve'])->name('clientReservation');
Route::get('/client/invoice', [App\Http\Controllers\ClientController::class, 'viewInvoices'])->name('clientInvoice');
