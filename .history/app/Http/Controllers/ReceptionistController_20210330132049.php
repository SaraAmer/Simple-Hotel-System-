<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Receptionist ;
use App\Models\Client;
use App\Models\User;
use App\Models\Reservation;

class ReceptionistController extends Controller
{

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
        return view('Receptionist.ManageClient',
        ['ManagedClients'=> $ManagedClients]);
    }

    function ApprovedClient() //to show all ApprovedClient who receptionist approve them Only
    {    //table clients have approved clients   
        //table clients id,name,email,gender,mobile,country,approvalID,approvalRole,has_reservations,avatar_image
        // $ApprovedClient=[
        //         ['name'=>'Marwa','email'=>'eng.marwamedhat2020@gmail.com','mobile'=>'012888888','country'=>'Egypt','gender'=>'female'],
        //         ['name'=>'rana','email'=>'eng.ranaamedhat2020@gmail.com','mobile'=>'0128888888','country' => 'Egypt','gender'=>'female'],
        // ];
        $ApprovedClient=Client :: all();
        return view('Receptionist.ApprovedClient',
        ['ApprovedClient'=>  $ApprovedClient]);

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

        return view('Receptionist.ClientReservation',
        ['ClientReservation'=> $ClientReservation],[ 'ClientReservationName'=>$ClientReservationName]);
    }
    function profile() 
    {
        $Receptionist= Receptionist  :: where('id',1)->first();
        //Check on Email get from url which i can  get using parameter input as it's different from one to another 
        // $Receptionist= Receptionist  :: where('email',)->first();

        // @dd($Receptionist);
        return view('Receptionist/ProfileReceptionist',['Receptionist'=> $Receptionist]);

    }
    function acceptClient ($email)
    {
        // dd($email);
      $accepteduser=User ::where('email',$email)->first();
      dd($accepteduser);
    }

    //when Click decline .. client record will remove from registration table 
    //when click Accept ... client data will store in Clients table 
    
    // public function destory($clientId)
    // {
    //     // ------------------------------------------
    //     // @dd($clientId);
    //     Registration::find($clientId)->delete();
    //     return redirect()->route('Receptionist.ManageClient');
    // }



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

}
