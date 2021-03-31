<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Client;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;



class ClientController extends Controller
{
    //
    public function index(){
      
        $client=Client::where('email', Auth::user()->email)->first();

        return view('client.index', [
            'client' => $client
        ]);
    }
    public function home(){
        $client=Client::where('email', Auth::user()->email)->first();
        $clientName= $client['name'];
        $rooms= Room::where('status', 'available')->get();
 
        return view('client.home', [
            'rooms' => $rooms,
            'clientName'=>$clientName

        ]);
    }

    public function reserve(){}

    public function viewInvoices($roomNumber){
       
        $client=Client::where('email', Auth::user()->email)->first();
        $room= Room::where('room_number', $roomNumber)->first();
        
        return view('client.invoice', [
            'client'=>$client,
            'room'=> $room
        ]);
    }


    public function checkout($amount){
        $client=Client::where('email', Auth::user()->email)->first();

        //dd($amount);
        return view('client.checkout', [
            'amount'=>$amount,
            'client'=>$client,
            
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
    public function deleteclient($id){

   
        @dd($id);
        Registration ::find($id)->delete($id);
        return response()->json([
    
            'success' => 'Record deleted successfully!'
    
        ]);
    
    }
   
}
