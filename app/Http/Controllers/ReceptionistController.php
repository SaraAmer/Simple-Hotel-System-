<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Client;

use App\Models\Reservation;

class ReceptionistController extends Controller
{

    function ManageClient() 
    {
        //to show all client who haven't approved and approve them 
        //So get data from Registrations table 
        //id,name,email,mobile,email
        $ManagedClients=[
            ['name'=>'Marwa','email'=>'eng.marwamedhat2020@gmail.com','mobile'=>'012888888','country'=>'Egypt','gender'=>'female'],
            ['name'=>'rana','email'=>'eng.ranaamedhat2020@gmail.com','mobile'=>'0128888888','country' => 'Egypt','gender'=>'female'],
        ];
        $ManagedClients=Registration :: all();
        return view('Receptionist.ManageClient',
        ['ManagedClients'=> $ManagedClients]);
    }

    function ApprovedClient() //to show all ApprovedClient who receptionist approve them Only
    {    //table clients have approved clients   
        //table clients id,name,email,gender,mobile,country,approvalID,approvalRole,has_reservations,avatar_image
        // $ApprovedClient=[
        //         ['name'=>'Marwa','email'=>'eng.marwamedhat2020@gmail.com','mobile'=>'012888888','country'=>'Egypt','gender'=>'female'],
        //         ['name'=>'rana','email'=>'eng.ranaamedhat2020@gmail.com','mobile'=>'0128888888','country' => 'Egypt','gender'=>'female'],
        // ];
        $ApprovedClient=Client :: all();
        return view('Receptionist.ApprovedClient',
        ['ApprovedClient'=>  $ApprovedClient]);

    }
    function ClientReservation() 
    {      //to show all ApprovedClientReservation which recieptionist approve them Only
        //table reservations has id,Client_id,accompany_number,room_number,paid price
        //table clients  name,email,.... (i need clientname where id=)
        // $ClientReservation=[  //name of key is the same as name of databaseColoum
        // ['name'=>'Marwa','accompany_number'=>3,'room_number'=>1,'paid price'=>200],
        // ['name'=>'Marwa','accompany_number'=>3,'room_number'=>1,'paid price'=>200],
        // ];
        $ClientReservation=Reservation :: all();
        $ClientReservationName=Client :: all();

        return view('Receptionist.ClientReservation',
        ['ClientReservation'=> $ClientReservation],[ 'ClientReservationName'=>$ClientReservationName]);
    }
    function profile() 
    {
        return view('Receptionist/ProfileReceptionist');

    }



}
