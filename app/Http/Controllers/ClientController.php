<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Client;
use App\Models\Receptionist;
use App\Models\Room;
use DateTime;

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
    // User::where('last_login_at', '>=', new DateTime('-1 months'))->get(); 
    // now()->format('Y-m-d')
    // dd( new DateTime('-1 months'));

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
        //to show all client who haven't approved and approve them
        //So get data from user table where role is pended client
        //OR for more information get data from Registration table which store All pended client in it 
    //    $ManagedClients=User ::where('role', 'pended client')->get();
        $ManagedClientsdata= Registration:: all();
        return view(
            'client.ManageClient',
            // ['ManagedClients'=> $ManagedClients],
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
        //if who login system is receptionist so 
        //go to client table where all accepted client store in it 
        //and id of receptionist is equal to approvalID so get client
        //Approval role is receptionist
        if (Auth::user()->role == "Receptionist") {
            $ApprovedClient=Client :: where('aprovalID', Auth::user()->user_id)->get();
            // dd(Auth::user()->id);
            // dd($ApprovedClient);
        }
        //if another user (any Approval Role) except receptionist so Appear all accepted client  
        else {
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
    //Show
    public function ClientReservation()
    {
        //has reservation if yes y3rd al data bta3t al clent da 
       
        //if Role is Receptionist so appear all client who accept them and its reservation
        //2li da5l recieptionst w al w al id bta3o howa id al approve

        // if (Auth::user()->role == "Receptionist") {
        //     $ApprovedClient=Client :: where('aprovalID', Auth::user()->user_id)->get();
        //     // dd(Auth::user()->id);
        //     dd($ApprovedClient);
        // }
        if (Auth::user()->role == "Receptionist") 
        {
            // dd(Auth::user()->user_id);
            // $ClientApprovedByReceptionist = Client ::where('aprovalID', Auth::user()->user_id);
            $ApprovedClient=Client :: where('aprovalID', Auth::user()->user_id)->get();
            // dd( $ApprovedClient);

            foreach($ApprovedClient as $client )
            {
                // @dd($client);
                // dd($client->has_reservations);
               if($client->has_reservations == "yes")
               {
            // // // if ($ClientApprovedByReceptionist->has_reservations == 'yes')
            $ClientReservation=Reservation:: where('client_id', $client->id)->get();
            //         // dd($ClientReservation);
               }
            }
        }
        //if role not receptionist so appear All client
        else
        {
            $ClientReservation=Reservation:: all();
        }

            return view(
                'client.ClientReservation',
                ['ClientReservation'=>$ClientReservation]
            );
        
    }
     
    
    public function acceptClient($email)
    {
        //2li 3aml account
        $accepteduser=User ::where('email', $email)->first();
        $accepteduser->update(['role' => "client"]);
        $accepteduser->notify(new WelcomeClient());
        //search in registeration table with email and when
        //find it store in Client table and delete it from registeration
        $acceptedClient=Registration ::where('email', $email)->first();
        // $acceptedid=User ::where('email',Auth::user()->email)->first();

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
    public function pendedclienthome()
    {
        return view('client.pendedclient');

    }
}
