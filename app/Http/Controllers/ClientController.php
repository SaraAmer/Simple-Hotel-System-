<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Client;
use App\Models\Receptionist;
use App\Models\Room;


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
        $client=Client::where('email', Auth::user()->email)->first();


        return view('client.index', [
            'client' => $client
        ]);
    }

    public function home()
    {
        if (!Auth::user()->hasRole('client')) {
            Auth::user()->assignRole('client');
        }
      
        $client=Client::where('email', Auth::user()->email)->first();
     
       
        return view('client.home', [
          
            'client'=>$client

        ]);
    }
   



    public function reserve()
    {
    }


    public function viewInvoices($roomNumber)
    {
        $client=Client::where('email', Auth::user()->email)->first();
        $room= Room::where('room_number', $roomNumber)->first();
        

        return view('client.invoice', [
            'client'=>$client,
            'room'=> $room
        ]);
    }


    public function checkout($amount)
    {
        $client=Client::where('email', Auth::user()->email)->first();

        return view('client.checkout', [
            'amount'=>$amount,
            'client'=>$client,
            
        ]);
    }
    public function ManageClient()
    {
        $ManagedClients=User ::where('role', 'pended client')->get();
        $ManagedClientsdata= Registration:: all();
        return view(
            'client.ManageClient',
            ['ManagedClients'=> $ManagedClients],
            ['ManagedClientsdata'=> $ManagedClientsdata]
        );
    }


    public function destory($clientId)
    {
        Registration::find($clientId)->delete();
        return redirect()->route('Receptionist.ManageClient');
    }

    public function ApprovedClient()
    {
        ;
        if (Auth::user()->role == "Receptionist") {
            $ApprovedClient=Client :: where('aprovalID', Auth::user()->id)->get();
        } else {
            $ApprovedClient=Client :: all();
        }
        return view(
            'client.ApprovedClient',
            ['ApprovedClient'=>  $ApprovedClient]
        );
    }

    public function deleteclient($id)
    {
        Registration ::find($id)->delete($id);
        return response()->json([

            'success' => 'Record deleted successfully!'

        ]);
    }
    public function ClientReservation()
    {
        // if (Auth::user()->role=="Receptionist") {
        //     $receptionist = Receptionist::where('email', Auth::user()->email)->first();
        //     $ClientReservation=Reservation:: where('aprovalID', $receptionist->id)->get();
        //     return view(
        //         'client.ClientReservation',
        //         ['ClientReservation'=>$ClientReservation]
        //     );
        // } else {
        $ClientReservation=Reservation ::all();
        
        return view(
            'client.ClientReservation',
            [ 'ClientReservation'=>$ClientReservation]
        );
        // }
    }
     
    
    public function acceptClient($email)
    {
        $accepteduser=User ::where('email', $email)->first();

        $accepteduser->update(['role' => "client"]);
        $accepteduser->notify(new WelcomeClient());
        //search in registeration table with email and when
        //find it store in Client table and delete it from registeration
        $acceptedClient=Registration ::where('email', $email)->first();
        $client = new Client;
        $client->name= $acceptedClient->name;
        $client->email = $acceptedClient->email;
        $client->mobile = $acceptedClient->mobile;
        $client->country = $acceptedClient->country;
        $client->gender = $acceptedClient->gender;
        //   $client->password = $acceptedClient->password;
        $client->has_reservations="no";
        $client->aprovalRole=Auth::user()->role;
        $client->aprovalID=Auth::user()->user_id;
        $client->save();
        Registration ::where('email', $email)->first()->delete();

        return redirect()->route('Receptionist.ManageClient');
    }
}
