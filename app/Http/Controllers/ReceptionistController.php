<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Client;

use App\Models\Reservation;

class ReceptionistController extends Controller
{
    public function ManageClient()
    {
        $ManagedClients=[
            ['name'=>'Marwa','email'=>'eng.marwamedhat2020@gmail.com','mobile'=>'012888888','country'=>'Egypt','gender'=>'female'],
            ['name'=>'rana','email'=>'eng.ranaamedhat2020@gmail.com','mobile'=>'0128888888','country' => 'Egypt','gender'=>'female'],
        ];
        $ManagedClients=Registration :: all();
        return view(
            'Receptionist.ManageClient',
            ['ManagedClients'=> $ManagedClients]
        );
    }

    public function ApprovedClient()
    {
        $ApprovedClient=Client :: all();
        return view(
            'Receptionist.ApprovedClient',
            ['ApprovedClient'=>  $ApprovedClient]
        );
    }
    public function ClientReservation()
    {
        $ClientReservation=Reservation :: all();
        $ClientReservationName=Client :: all();

        return view(
            'Receptionist.ClientReservation',
            ['ClientReservation'=> $ClientReservation],
            [ 'ClientReservationName'=>$ClientReservationName]
        );
    }
    public function profile()
    {
        return view('Receptionist/ProfileReceptionist');
    }
}
