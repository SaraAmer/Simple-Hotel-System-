<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\ManageClientController;
use  App\Http\Controllers\ClientReservationController;
use App\Http\Controllers\ApprovedClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\ManagersController;
use App\Http\Controllers\ReceptionistsController;
use App\Http\Controllers\ReceptionistController;

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
Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin', function () {
    return view('Admin/adminStartPage');
});

Route::get('/receptionist', function () { //da 2li bktbo fe al url
    return view('Receptionist/receptionist'); //in rresource/views/Receptionist
});



// Route::get('/receptionist/manageclient', function () { //da 2li bktbo fe al url
//     return view('Receptionist/ManageClient'); //in rresource/views/Receptionist
// });

// Route::get('/receptionist/clientreservation', function () { //da 2li bktbo fe al url
//     return view('Receptionist/ClientReservation'); //in rresource/views/Receptionist
// });


// Route::get('/receptionist/approvalclient', function () { //da 2li bktbo fe al url
//     return view('Receptionist/ApprovedClient'); //in rresource/views/Receptionist
// });
// Route::get('/receptionist/profile', function () { //da 2li bktbo fe al url
//     return view('Receptionist/ProfileReceptionist'); //in rresource/views/Receptionist
// });

Route::middleware(['auth','receptionist','admin'])->group(function () {
    Route::get('/receptionist/profile', [ReceptionistController::class, 'profile'])->name('Receptionist.profile');
    Route::get('/receptionist/ManageClient', [ReceptionistController::class, 'ManageClient'])->name('Receptionist.ManageClient');
    Route::get('/receptionist/ClientReservation', [ReceptionistController::class, 'ClientReservation'])->name('Receptionist.ClientReservation');
    Route::get('/receptionist/ApprovedClient', [ReceptionistController::class, 'ApprovedClient'])->name('Receptionist.ApprovedClient');
    Route::get('/receptionist/acceptClient/{client}', [ReceptionistController::class, 'acceptClient'])->name('acceptClient');

});


//Admin ONLY can....................................................
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth','admin'])->group(function () {
    Route::get('/managers', [ManagersController::class, 'index'])->name('managers.index');
    Route::post('/managers', [ManagersController::class, 'store'])->name('managers.store');
    Route::get('/managers/create', [ManagersController::class, 'create'])->name('managers.create');
    Route::get('/managers/{manager}/edit', [ManagersController::class, 'edit'])->name('managers.edit');
    Route::put('/managers/{manager}', [ManagersController::class, 'update'])->name('managers.update');
    Route::delete('/managers/{manager}', [ManagersController::class, 'destroy'])->name('managers.destroy');
});

//Admin OR manager can........................
Route::middleware(['auth','manager'])->group(function () {
    Route::get('/receptionists', [ReceptionistsController::class, 'index'])->name('receptionists.index');
    Route::post('/receptionists', [ReceptionistsController::class, 'store'])->name('receptionists.store');
    Route::get('/receptionists/create', [ReceptionistsController::class, 'create'])->name('receptionists.create');
    Route::get('/receptionists/{receptionist}/edit', [ReceptionistsController::class, 'edit'])->name('receptionists.edit');
    Route::put('/receptionists/{receptionist}', [ReceptionistsController::class, 'update'])->name('receptionists.update');
    Route::delete('/receptionists/{receptionist}', [ReceptionistsController::class, 'destroy'])->name('receptionists.destroy');

    Route::get('/manger/profile', [ManagersController::class,'profile'])->name('manager.profile');
});


Route::middleware(['auth','admin'])->group(function () {
    Route::get('/rooms', [RoomsController::class, 'index'])->name('rooms.index');
    Route::post('/rooms', [RoomsController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/create', [RoomsController::class, 'create'])->name('rooms.create');
    Route::get('/rooms/{room}/edit', [RoomsController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{room}', [RoomsController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{room}', [RoomsController::class, 'destroy'])->name('rooms.destroy');
});


//Client

Route::get('/client', [App\Http\Controllers\ClientController::class, 'index'])->name('client')->middleware('auth');
Route::get('/client/home', [App\Http\Controllers\ClientController::class, 'home'])->name('clientHome')->middleware('auth');
Route::get('/client/reservation', [App\Http\Controllers\ClientController::class, 'reserve'])->name('clientReservation')->middleware('auth');
Route::get('/client/invoice', [App\Http\Controllers\ClientController::class, 'viewInvoices'])->name('clientInvoice')->middleware('auth');

//floors
Route::get('/floors', [App\Http\Controllers\FloorsController::class, 'index'])->name('floors.index');
Route::post('/floors', [App\Http\Controllers\FloorsController::class, 'store'])->name('floors.store');

Route::get('/floors/create', [App\Http\Controllers\FloorsController::class, 'create'])->name('floors.create');
Route::Delete('/floors/{floor}', [App\Http\Controllers\FloorsController::class, 'destroy'])->name('floors.destroy');

Route::get('/floors/{floor}/edit', [App\Http\Controllers\FloorsController::class, 'edit'])->name('floors.edit');

Route::put('/floors/{floor}', [App\Http\Controllers\FloorsController::class, 'update'])->name('floors.update');




Route::middleware('auth', 'receptionist')->group(function () {
    Route::get('/client', [App\Http\Controllers\ClientController::class, 'index'])->name('client');
    Route::get('/client/home', [App\Http\Controllers\ClientController::class, 'home'])->name('clientHome');
    Route::get('/client/reservation', [App\Http\Controllers\ClientController::class, 'reserve'])->name('clientReservation');
    Route::get('/client/invoice', [App\Http\Controllers\ClientController::class, 'viewInvoices'])->name('clientInvoice');
});

//detory fn execute from ClientController 
//Route from url is http://127.0.0.1:8000/clients/{client} (1,2,3,...)
Route::delete('/clients/{client}', [App\Http\Controllers\ClientController::class, 'destory'])->name('clients.destory');
Route::post('/clients', [App\Http\Controllers\ClientController::class, 'store'])->name('clients.store');

// Route::delete('clients/{id}', [App\Http\Controllers\ClientController::class, 'deleteclient'])->name('client.delete');