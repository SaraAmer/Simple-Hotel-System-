<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ReceptionistController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//http://127.0.0.1:8000/api/receptionist/ManageClient
// Route::middleware(['auth','receptionist' ,'forbid-banned-user'])->group(function () {
    Route::get('/receptionist/ManageClient', [ReceptionistController::class, 'ManageClient'])->name('Receptionist.ManageClient');
    Route::get('/receptionist/ApprovedClient', [ReceptionistController::class, 'ApprovedClient'])->name('Receptionist.ApprovedClient');
    Route::get('/receptionist/ClientReservation', [ReceptionistController::class, 'ClientReservation'])->name('Receptionist.ClientReservation');
    Route::get('/receptionist/acceptClient/{client}', [ReceptionistController::class, 'acceptClient'])->name('acceptClient');

    // });