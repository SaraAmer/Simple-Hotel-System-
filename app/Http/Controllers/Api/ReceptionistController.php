<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Receptionist ;
use App\Models\Client;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ReceptionistResource;
use App\Http\Resources\ReservationResource; 
use App\Http\Resources\RoomResource; 


class ReceptionistController extends Controller
{
       //display All pended clients as same as index function
       //http://127.0.0.1:8000/api/receptionist/ManageClient
    function ManageClient() 
    {  
       
        $PendedClientsdata=Registration:: all();
        return ReceptionistResource::collection($PendedClientsdata);
    }


   //display all approvedClient as same as index function
   //http://127.0.0.1:8000/api/receptionist/ApprovedClient
    function ApprovedClient() 
    {    
        // if(Auth::user()->role == "Receptionist")
        // {
        //     $ApprovedClient=Client :: where('aprovalID',Auth::user()->id)->get();
        // }
        // else
        // {
        $ApprovedClient=Client :: all();
        // }
        return ReceptionistResource::collection($ApprovedClient);


    }
    //http://127.0.0.1:8000/api/receptionist/ClientReservation
    function ClientReservation() 
    {     

        $ClientReservation=Reservation :: all();
        // $ClientReservationName=Client :: all();
        // ['ClientReservation'=> $ClientReservation],[ 'ClientReservationName'=>$ClientReservationName]);
        return ReservationResource::collection($ClientReservation);

    }
    //display specific client which is pendedclient
    //as same as show function
    //http://127.0.0.1:8000/api/receptionist/acceptClient/15
    function acceptClient (Registration $client)
    {
      return new ReceptionistResource($client);
    }
    // function all()
    // {
    //     dd("we are in index");
    // }
}
