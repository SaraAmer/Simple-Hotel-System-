<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\RoomController;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
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
//Authanticatioon using package sanctum not web application
//so send token in header 
//Authorization Bearer
//Accept application/json
    Route::get('/receptionist/ManageClient', [ClientController::class, 'ManageClient'])->name('Receptionist.ManageClient')->middleware('auth:sanctum');
    Route::get('/receptionist/ApprovedClient', [ClientController::class, 'ApprovedClient'])->name('Receptionist.ApprovedClient');
    Route::get('/receptionist/ClientReservation', [ClientController::class, 'ClientReservation'])->name('Receptionist.ClientReservation');
    Route::get('/receptionist/acceptClient/{client}', [ClientController::class, 'acceptClient'])->name('acceptClient');
   

//to get token for login user 
//validate data then comapre email user with existinng users and compare  password 
//if correct so create token ,, if not through exception
//Method post , header Accept json ,body form data write the same email i want to login with it
//write password and device name 
//http://127.0.0.1:8000/api/sanctum/token
//token of  1|xVJh4CTjZEYXbRm8uqkC7ucsULBAw07HCucg6vnn
//eng.marwamedhat2020@gmail.com
//password:123456789
//device_name:samsung.

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});