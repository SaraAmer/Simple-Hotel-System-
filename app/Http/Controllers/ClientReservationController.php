<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientReservationController extends Controller
{
    //
    function Index() //to show all ManageClient
    {
        $ClientReservation=[
        ['id'=>1,'Name'=>'Marwa','accompanyNumber'=>3,'roomNumber'=>1],
        ['id'=>1,'Name'=>'Marwa','accompanyNumber'=>3,'roomNumber'=>1],
        ];
        return view('Receptionist.ClientReservation',
        ['ClientReservation'=> $ClientReservation]);

    }
}
