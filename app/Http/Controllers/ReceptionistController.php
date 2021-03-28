<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceptionistController extends Controller
{

    function ManageClient() 
    {
        //to show all client who haven't approved and approve them 
        //So get data from Registrations table 
        //id,name,email,mobile,email
        $ManagedClients=[
            ['id'=>1,'name'=>'Marwa','email'=>'eng.marwamedhat2020@gmail.com','mobile'=>'012888888','gender'=>'female'],
            ['id'=>2,'name'=>'rana','email'=>'eng.ranaamedhat2020@gmail.com','mobile'=>'0128888888','gender'=>'female'],
        ];
        return view('Receptionist.ManageClient',
        ['ManagedClients'=> $ManagedClients]);

    }
    function ApprovedClient() //to show all ApprovedClient who receptionist approve them Only
    {    //table clients have approved clients   
        //table clients id,name,email,gender,mobile,country,approvalID,approvalRole,has_reservations,avatar_image
        $ApprovedClient=[
                ['id'=>1,'name'=>'Marwa','email'=>'eng.marwamedhat2020@gmail.com','mobile'=>'012888888','gender'=>'female'],
                ['id'=>2,'name'=>'rana','email'=>'eng.ranaamedhat2020@gmail.com','mobile'=>'0128888888','gender'=>'female'],
        ];
        return view('Receptionist.ApprovedClient',
        ['ApprovedClient'=>  $ApprovedClient]);

    }
    function ClientReservation() 
    {      //to show all ApprovedClientReservation which recieptionist approve them Only
        //table reservations has id,Client_id,accompany_number,room_number,paid price
        //table clients  name,email,.... (i need clientname where id=)
        $ClientReservation=[
        ['Name'=>'Marwa','accompanyNumber'=>3,'roomNumber'=>1,'clientpaidprice'=>200],
        ['Name'=>'Marwa','accompanyNumber'=>3,'roomNumber'=>1,'clientpaidprice'=>200],
        ];
        return view('Receptionist.ClientReservation',
        ['ClientReservation'=> $ClientReservation]);
    }
    function profile() 
    {
        return view('Receptionist/ProfileReceptionist');

    }



}
