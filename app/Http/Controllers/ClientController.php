<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;

use App\Models\Receptionist ;
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
    function ManageClient() 
    {
        //to show all client who haven't approved and approve them 
        //So get data from Registrations table 
        //id,name,email,mobile,email
        $ManagedClients=[
            ['name'=>'Marwa','email'=>'eng.marwamedhat2020@gmail.com','mobile'=>'012888888','country'=>'Egypt','gender'=>'female'],
            ['name'=>'rana','email'=>'eng.ranaamedhat2020@gmail.com','mobile'=>'0128888888','country' => 'Egypt','gender'=>'female'],
        ];
        $ManagedClients=User ::where('role','pended client')->get();
        $ManagedClientsdata= Registration:: all();
        return view('client.ManageClient',
        ['ManagedClients'=> $ManagedClients],['ManagedClientsdata'=> $ManagedClientsdata]);
    }

     
    public function destory($clientId)
    {
        // ------------------------------------------
        // @dd($clientId);
        Registration::find($clientId)->delete();
        return redirect()->route('Receptionist.ManageClient');
    }

    function ApprovedClient() //to show all ApprovedClient who receptionist approve them Only
    {    //table clients have approved clients   
        //table clients id,name,email,gender,mobile,country,approvalID,approvalRole,has_reservations,avatar_image
        // $ApprovedClient=[
        //         ['name'=>'Marwa','email'=>'eng.marwamedhat2020@gmail.com','mobile'=>'012888888','country'=>'Egypt','gender'=>'female'],
        //         ['name'=>'rana','email'=>'eng.ranaamedhat2020@gmail.com','mobile'=>'0128888888','country' => 'Egypt','gender'=>'female'],
        // ];
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
    public function deleteclient($id){

   
        @dd($id);
        Registration ::find($id)->delete($id);
        return response()->json([
    
            'success' => 'Record deleted successfully!'
    
        ]);
    
    }
    function ClientReservation() 
    {      //to show all ApprovedClientReservation which recieptionist approve them Only
        //table reservations has id,Client_id,accompany_number,room_number,paid price
        //table clients  name,email,.... (i need clientname where id=)
        // $ClientReservation=[  //name of key is the same as name of databaseColoum
        // ['name'=>'Marwa','accompany_number'=>3,'room_number'=>1,'paid price'=>200],
        // ['name'=>'Marwa','accompany_number'=>3,'room_number'=>1,'paid price'=>200],
        // ];
        $ClientReservation=Reservation :: all();
        $ClientReservationName=Client :: all();

        return view('client.ClientReservation',
        ['ClientReservation'=> $ClientReservation],[ 'ClientReservationName'=>$ClientReservationName]);
    }
     
    function acceptClient ($email)
    {
        // dd($email);
        // @dd(Auth::user()->role);
      $accepteduser=User ::where('email',$email)->first();
    //   dd($accepteduser);

      $accepteduser->update(['role' => "client"]);
    //   dd($accepteduser);
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
