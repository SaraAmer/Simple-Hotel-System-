<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index(){
        $clientData=[
            'name'=> 'Eithar',
            'gender'=> 'Female',
            'phoneNo' => '123456',
            'email'=> 'eithar@yahoo.com',
            'country'=> 'Alex'
        ];
        return view('client.index', [
            'client' => $clientData
        ]);
    }
    public function home(){
        $clientName= "Eithar";
        $rooms=[
            'room1'=>[
                'capacity'=> 2,
                'price'=> 100,
                'status'=> 'Available'
            ],
            'room2'=> [
                'capacity'=> 5,
                'price'=> 200,
                'status'=> 'Unavailable'
            ]
        ];
        return view('client.home', [
            'rooms' => $rooms,
            'clientName'=>$clientName

        ]);
    }

    public function reserve(){}

    public function viewInvoices(){
        $clientName= "Eithar";
        return view('client.invoice', [
            'clientName'=>$clientName
        ]);
    }

}
