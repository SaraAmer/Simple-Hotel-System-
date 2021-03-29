<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\ManageClientController;
use  App\Http\Controllers\ClientReservationController;
use App\Http\Controllers\ApprovedClientController;
use App\Http\Controllers\HomeController;
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
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/receptionist/profile', [ReceptionistController::class, 'profile'])->name('Receptionist.profile')->middleware(['auth','receptionist']);
Route::get('/receptionist/ManageClient', [ReceptionistController::class, 'ManageClient'])->name('Receptionist.ManageClient')->middleware(['auth','receptionist']);
Route::get('/receptionist/ClientReservation', [ReceptionistController::class, 'ClientReservation'])->name('Receptionist.ClientReservation')->middleware(['auth','receptionist']);
Route::get('/receptionist/ApprovedClient', [ReceptionistController::class, 'ApprovedClient'])->name('Receptionist.ApprovedClient')->middleware(['auth','receptionist']);


//Admin ONLY can....................................................


Route::get('/managers', [ManagersController::class, 'index'])->name('managers.index')->middleware(['auth','admin']);
Route::post('/managers', [ManagersController::class, 'store'])->name('managers.store')->middleware(['auth','admin']);
Route::get('/managers/create', [ManagersController::class, 'create'])->name('managers.create')->middleware(['auth','admin']);

Route::get('/managers/{manager}/edit', [ManagersController::class, 'edit'])->name('managers.edit')->middleware(['auth','admin']);

Route::put('/managers/{manager}', [ManagersController::class, 'update'])->name('managers.update')->middleware(['auth','admin']);

Route::delete('/managers/{manager}', [ManagersController::class, 'destroy'])->name('managers.destroy')->middleware(['auth','admin']);

//Admin OR manager can........................

Route::get('/receptionists', [ReceptionistsController::class, 'index'])->name('receptionists.index')->middleware(['auth','manager']);
Route::post('/receptionists', [ReceptionistsController::class, 'store'])->name('receptionists.store')->middleware(['auth','manager']);

Route::get('/receptionists/create', [ReceptionistsController::class, 'create'])->name('receptionists.create')->middleware(['auth','manager']);

Route::get('/receptionists/{receptionist}/edit', [ReceptionistsController::class, 'edit'])->name('receptionists.edit')->middleware(['auth','manager']);

Route::put('/receptionists/{receptionist}', [ReceptionistsController::class, 'update'])->name('receptionists.update')->middleware(['auth','manager']);

Route::delete('/receptionists/{receptionist}', [ReceptionistsController::class, 'destroy'])->name('receptionists.destroy')->middleware(['auth','manager']);


Route::delete('/receptionists', [ReceptionistsController::class, 'destroy'])->name('receptionists.destroy')->middleware(['auth','manager']);
Route::get('/manger/profile', [ManagersController::class,'profile'])->name('manager.profile')->middleware(['auth','manager']);




//Client

Route::get('/client', [App\Http\Controllers\ClientController::class, 'index'])->name('client')->middleware('auth');
Route::get('/client/home', [App\Http\Controllers\ClientController::class, 'home'])->name('clientHome')->middleware('auth');
Route::get('/client/reservation', [App\Http\Controllers\ClientController::class, 'reserve'])->name('clientReservation')->middleware('auth');
Route::get('/client/invoice', [App\Http\Controllers\ClientController::class, 'viewInvoices'])->name('clientInvoice')->middleware('auth');

//floors
Route::get('/floors', [App\Http\Controllers\FloorsController::class, 'index'])->name('floors.index');
Route::post('/floors', [App\Http\Controllers\FloorsController::class, 'store'])->name('floors.store');

Route::get('/floors/create', [App\Http\Controllers\FloorsController::class, 'create'])->name('floors.create');
Route::get('/floors/{floor}', [App\Http\Controllers\FloorsController::class, 'destroy '])->name('floors.destroy');

Route::get('/receptionists/{receptionist}/edit', [ReceptionistsController::class, 'edit'])->name('receptionists.edit');

Route::put('/receptionists/{receptionist}', [ReceptionistsController::class, 'update']);


Route::get('/notfound', function () {
    return view('404');
});
