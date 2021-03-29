<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceptionistController extends Controller
{

    function ClientReservation() //to show all ManageClient
    {
        $ClientReservation=[
        ['id'=>1,'Name'=>'Marwa','accompanyNumber'=>3,'roomNumber'=>1],
        ['id'=>1,'Name'=>'Marwa','accompanyNumber'=>3,'roomNumber'=>1],
        ];
        return view('Receptionist.ClientReservation',
        ['ClientReservation'=> $ClientReservation]);

    }
    function ApprovedClient() //to show all ManageClient
    {
        $ApprovedClient=[
        // ['id'=>1,'Name'=>'Marwa','email'=>'eng.marwamedhat2020@gmail.com','mobile'=>012888888,'gender'=>'female'],
        // ['id'=>2,'Name'=>'rana','email'=>'eng.ranaamedhat2020@gmail.com','mobile'=>0128888888,'gender'=>'female'],
                ['id'=>1,'Name'=>'Marwa','email'=>'eng.marwamedhat2020@gmail.com','mobile'=>'012888888','gender'=>'female'],
                ['id'=>2,'Name'=>'rana','email'=>'eng.ranaamedhat2020@gmail.com','mobile'=>'0128888888','gender'=>'female'],

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
    function profile() //to show all ManageClient
    {
        return view('Receptionist/ProfileReceptionist');

    }



}
