<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;

class ClientController extends Controller
{
    //
    public function index()
    {
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
    public function home()
    {
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

    public function reserve()
    {
    }

    public function viewInvoices()
    {
        $clientName= "Eithar";
        return view('client.invoice', [
            'clientName'=>$clientName
        ]);
    }


    public function destory($clientId)
    {
        // ------------------------------------------
        // @dd($clientId);
        Registration::find($clientId)->delete();
        return redirect()->route('Receptionist.ManageClient');
    }
    //store in Client table data of Registeration table
    // public function store(Request $request)
    // {
    //     // 'name',
    //     // 'email',
    //     // 'password',
    //     // 'gender',
    //     // 'mobile',
    //     // 'country',
    //     // 'aprovalID',
    //     // 'aprovalRole',
    //     // 'has_reservations',
    //     // 'avatar_image',
    //     @dd($request);
    //     @dd("store method");
    //     $client = new Client;
    //     $client->name= $request->name;
    //     $client->email = $request->email;

    //     $client->save();
    //     return redirect()->route('Receptionist.ManageClient');
    // }
    public function deleteclient($id)
    {
        @dd($id);
        Registration ::find($id)->delete($id);
        return response()->json([

            'success' => 'Record deleted successfully!'

        ]);
    }
}
