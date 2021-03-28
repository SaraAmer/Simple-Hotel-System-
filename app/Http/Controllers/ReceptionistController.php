<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceptionistController extends Controller
{

    function ClientReservation() //to show all ManageClient
    {
        //table reservations has id,Client_id,accompany_number,room_number,paid price
        //table clients name,email,.... (i need clientname where id=)
        $ClientReservation=[
        ['id'=>1,'Name'=>'Marwa','accompanyNumber'=>3,'roomNumber'=>1],
        ['id'=>1,'Name'=>'Marwa','accompanyNumber'=>3,'roomNumber'=>1],
        ];
        return view('Receptionist.ClientReservation',
        ['ClientReservation'=> $ClientReservation]);

    }
    function ApprovedClient() //to show all ApprovedClient
    {
        //table clients id,name,email,gender,mobile,country,approvalID,approvalRole,has_reservations,avatar_image
        $ApprovedClient=[
                ['id'=>1,'name'=>'Marwa','email'=>'eng.marwamedhat2020@gmail.com','mobile'=>'012888888','gender'=>'female'],
                ['id'=>2,'name'=>'rana','email'=>'eng.ranaamedhat2020@gmail.com','mobile'=>'0128888888','gender'=>'female'],
        ];
        return view('Receptionist.ApprovedClient',
        ['ApprovedClient'=>  $ApprovedClient]);

    }
    function ManageClient() //to show all ManageClient
    {
        $ManagedClients=[
        ['id'=>1,'Name'=>'Marwa','accompanyNumber'=>3,'roomNumber'=>1,'ClientPaidPrice'=>200],
        ['id'=>1,'Name'=>'Marwa','accompanyNumber'=>3,'roomNumber'=>1,'ClientPaidPrice'=>200],
        ];
        return view('Receptionist.ManageClient',
        ['ManagedClients'=> $ManagedClients]);

    }
    function profile() 
    {
        return view('Receptionist/ProfileReceptionist');

    }



}
