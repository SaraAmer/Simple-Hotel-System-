<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;

use App\Models\Client;
use App\Models\User;
use App\Models\Reservation;
// use App\Http\Auth;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Notifications\Notifiable;
use App\Notifications\WelcomeClient;
use Notifiable;

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
    function ManageClient() 
    {
        
       
        $ManagedClients=User ::where('role','pended client')->get();
        $ManagedClientsdata= Registration:: all();
        return view('client.ManageClient',
        ['ManagedClients'=> $ManagedClients],['ManagedClientsdata'=> $ManagedClientsdata]);
    }


    public function destory($clientId)
    {
       
        Registration::find($clientId)->delete();
        return redirect()->route('Receptionist.ManageClient');
    }

    function ApprovedClient() 
    {   ;
        if(Auth::user()->role == "Receptionist")
        {
            $ApprovedClient=Client :: where('aprovalID',Auth::user()->id)->get();
        }
        else
        {
        $ApprovedClient=Client :: all();
        }
        return view('client.ApprovedClient',
        ['ApprovedClient'=>  $ApprovedClient]);
    }

    public function deleteclient($id)
    {
        @dd($id);
        Registration ::find($id)->delete($id);
        return response()->json([

            'success' => 'Record deleted successfully!'

        ]);
    }
    function ClientReservation() 
    {     
        $ClientReservation=Reservation :: all();
        $ClientReservationName=Client :: all();

        return view('client.ClientReservation',
        ['ClientReservation'=> $ClientReservation],[ 'ClientReservationName'=>$ClientReservationName]);
    }
     
    function acceptClient ($email)
    {
       
      $accepteduser=User ::where('email',$email)->first();

      $accepteduser->update(['role' => "client"]);
    $accepteduser->notify(new WelcomeClient());

      //search in registeration table with email and when 
      //find it store in Client table and delete it from registeration
      $acceptedClient=Registration ::where('email',$email)->first();
      $client = new Client;
      $client->name= $acceptedClient->name;
      $client->email = $acceptedClient->email;
      $client->mobile = $acceptedClient->mobile;
      $client->country = $acceptedClient->country;
      $client->gender = $acceptedClient->gender;
    //   $client->password = $acceptedClient->password; 
      $client->has_reservations="no";
      $client->aprovalRole=Auth::user()->role;
      $client->aprovalID=Auth::user()->id;
      $client->save();
      Registration ::where('email',$email)->first()->delete();

      return redirect()->route('Receptionist.ManageClient');
    }
   
}
