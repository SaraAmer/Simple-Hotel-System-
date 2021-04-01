<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\ManageClientController;
use  App\Http\Controllers\ClientReservationController;
use App\Http\Controllers\ApprovedClientController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FloorsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\ManagersController;
use App\Http\Controllers\ReceptionistsController;
use App\Http\Controllers\ReceptionistController;
use App\Models\Receptionist;

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
//Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth','receptionist' ,'forbid-banned-user'])->group(function () {
    Route::get('/receptionists/home', [ReceptionistsController::class, 'home'])->name('receptionist.home');
    Route::get('/receptionist/profile', [ReceptionistsController::class, 'profile'])->name('Receptionist.profile');
    Route::get('/receptionist/ManageClient', [ClientController::class, 'ManageClient'])->name('Receptionist.ManageClient');
    Route::get('/receptionist/ClientReservation', [ClientController::class, 'ClientReservation'])->name('Receptionist.ClientReservation');
    Route::get('/receptionist/ApprovedClient', [ClientController::class, 'ApprovedClient'])->name('Receptionist.ApprovedClient');
    Route::get('/receptionist/acceptClient/{client}', [ClientController::class, 'acceptClient'])->name('acceptClient');
});


//Admin ONLY can....................................................

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/managers', [ManagersController::class, 'index'])->name('managers.index');
    Route::post('/managers', [ManagersController::class, 'store'])->name('managers.store');
    Route::get('/managers/create', [ManagersController::class, 'create'])->name('managers.create');
    Route::get('/managers/{manager}/edit', [ManagersController::class, 'edit'])->name('managers.edit');
    Route::put('/managers/{manager}', [ManagersController::class, 'update'])->name('managers.update');
    Route::delete('/managers/{manager}', [ManagersController::class, 'destroy'])->name('managers.destroy');
});

//Admin OR manager can........................
Route::middleware(['auth','manager'])->group(function () {
    Route::get('/manager/home', [ManagersController::class, 'home'])->name('manager.home');
    Route::get('/receptionists', [ReceptionistsController::class, 'index'])->name('receptionists.index');
    Route::post('/receptionists', [ReceptionistsController::class, 'store'])->name('receptionists.store');
    Route::get('/receptionists/create', [ReceptionistsController::class, 'create'])->name('receptionists.create');
    Route::get('/receptionists/{receptionist}/edit', [ReceptionistsController::class, 'edit'])->name('receptionists.edit');
    Route::get('/receptionists/{receptionist}/ban', [ReceptionistsController::class, 'ban'])->name('receptionists.ban');
    Route::get('/receptionists/{receptionist}/unban', [ReceptionistsController::class, 'unban'])->name('receptionists.unban');
    Route::put('/receptionists/{receptionist}', [ReceptionistsController::class, 'update'])->name('receptionists.update');
    Route::delete('/receptionists/{receptionist}', [ReceptionistsController::class, 'destroy'])->name('receptionists.destroy');
    Route::get('/rooms', [RoomsController::class, 'index'])->name('rooms.index');
    Route::post('/rooms', [RoomsController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/create', [RoomsController::class, 'create'])->name('rooms.create');
    Route::get('/rooms/{room}/edit', [RoomsController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{room}', [RoomsController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{room}', [RoomsController::class, 'destroy'])->name('rooms.destroy');
    Route::get('/floors', [FloorsController::class, 'index'])->name('floors.index');
    Route::post('/floors', [FloorsController::class, 'store'])->name('floors.store');
    Route::get('/floors/create', [FloorsController::class, 'create'])->name('floors.create');
    Route::Delete('/floors/{floor}', [FloorsController::class, 'destroy'])->name('floors.destroy');
    Route::get('/floors/{floor}/edit', [FloorsController::class, 'edit'])->name('floors.edit');
    Route::put('/floors/{floor}', [FloorsController::class, 'update'])->name('floors.update');
});

//Client

Route::middleware('auth')->group(function () {
    Route::get('/client/home', [ClientController::class, 'home'])->name('client.home');
    Route::get('/client/browse', [RoomsController::class, 'showAvailabe'])->name('client.browse');
    Route::get('/client/checkout/{amount}', [ClientController::class, 'checkout'])->name('checkout');
    Route::get('/client/reservation', [ClientController::class, 'reserve'])->name('clientReservation');
    Route::get('/client/invoice/{roomNumber}', [ClientController::class, 'viewInvoices'])->name('client.invoice');
    Route::get('/client', [ClientController::class, 'index'])->name('client');
    Route::delete('/clients/{client}', [ClientController::class, 'destory'])->name('clients.destory');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/pendedclient', [ClientController::class, 'pendedclienthome'])->name('pendedclient.home');

});
