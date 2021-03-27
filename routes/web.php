<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\ManageClientController;
use  App\Http\Controllers\ClientReservationController;
use App\Http\Controllers\ApprovedClientController;
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
Route::get('/receptionist/ManageClient', [ManageClientController::class, 'index'])->name('Receptionist.ManageClient');
Route::get('/receptionist/ClientReservation', [ManageClientController::class, 'index'])->name('Receptionist.ClientReservation');

Route::get('/receptionist/ApprovedClient', [ApprovedClientController::class, 'index'])->name('Receptionist.ApprovedClient');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
