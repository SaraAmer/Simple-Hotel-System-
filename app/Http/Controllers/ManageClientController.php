<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageClientController extends Controller
{
    function Index() //to show all ManageClient
    {
        $ManagedClients=[
        ['id'=>1,'Name'=>'Marwa','accompanyNumber'=>3,'roomNumber'=>1],
        ['id'=>1,'Name'=>'Marwa','accompanyNumber'=>3,'roomNumber'=>1],
        ];
        return view('Receptionist.ManageClient',
        ['ManagedClients'=> $ManagedClients]);

    }
}
