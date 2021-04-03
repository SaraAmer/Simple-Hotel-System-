<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Registration;
use App\Models\Client;
use App\Models\Receptionist;
use App\Models\Room;
use DateTime;
use Yajra\Datatables\Datatables;
use App\Models\Manager;
use App\Models\User;
use App\Models\Reservation;
// use App\Http\Auth;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Notifications\Notifiable;
use App\Notifications\WelcomeClient;
use App\Notifications\remindClient;

use Notifiable;

class ClientController extends Controller
{
    public function index()
    {
        $client = Client::where('email', Auth::user()->email)->first();
        $rooms=Room::where('status', 'available')->get();

        return view('client.index', [
            'client' => $client,
            'rooms'=>$rooms
        ]);
    }
 

    public function home()
    {
        $rooms=Room::where('status', 'available')->get();
        if (!Auth::user()->hasRole('client')) {
            Auth::user()->assignRole('client');
        }
       
        $client = User::where('email', Auth::user()->email)->first();

        
        $client->update(['lastlogin' => now()->format('Y-m-d')]);

        $client->save();
       


        return view('client.home', [
            'client' => $client,

            'rooms'=> $rooms
        ]);
    }



    public function reserve()
    {
        $client = Client::where('email', Auth::user()->email)->first();
        $rooms=array();
        
        if ($client['has_reservations'] == "yes") {
            $reservations=Reservation::where('client_id', $client['id'])->get();
            //dd($reservedRoomsId[0]['room_number']);
            //dd(sizeof($reservedRoomsId));
            
            foreach ($reservations as $reserve) {
                // dd($reserve['room_number']);
              
                $room= Room::where('room_number', $reserve['room_number'])->first();
            
                array_push($rooms, $room);
            }
        }
        
        if (!Auth::user()->hasRole('client')) {
            Auth::user()->assignRole('client');
        }


        return view('client.reservations', [

            'client' => $client,
            'rooms'=> $rooms
        ]);
    }



    public function viewInvoices($roomNumber, Request $request)
    {
        $client=Client::where('email', Auth::user()->email)->first();
        $room= Room::where('room_number', $roomNumber)->first();
  



        return view('client.invoice', [
            'client' => $client,
            'room' => $room
        ]);
    }



    public function checkout($room)
    {
        $client=Client::where('email', Auth::user()->email)->first();


        return view('client.checkout', [

            'room'=>$room,
            'client'=>$client,


        ]);
    }
    public function ManageClient()
    {
        $ManagedClientsdata= Registration:: all();
        return view(
            'client.ManageClient',
            ['ManagedClientsdata'=> $ManagedClientsdata]
        );
    }
    public function getClientsData()
    {
        $RequestedClient=Registration::query();
        return Datatables::of($RequestedClient)->addColumn('action', function ($client) {
            return
           
                    ' <a "  href="' . route('acceptClient', $client->email) .'"><i class="fa fa-check" aria-hidden="true"></i></button>
                    <a href="" class="delete"  data-id="' .$client->id .'"> 
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>'
                     ;
            ;
        }) ->editColumn('created_at', function ($request) {
            return $request->created_at->format('Y-m-d');
        }) ->editColumn('updated_at', function ($request) {
            return $request->updated_at->format('Y-m-d');
        })->make(true);
    }

    public function delete($clientId)
    {
        $client=  Registration::findorfail($clientId);
        $user=User::where('email', $client->email);
        $client->delete();
        $user->delete();
        return response()->json([
            'message' => 'Data deleted successfully!'
          ]);
    }

    public function ApprovedClient()
    {
        return view('client.ApprovedClient');
    }
    public function getData()
    {
        if (Auth::user()->hasRole('admin')||Auth::user()->hasRole('manager')) {
            $client=Client::query();
            return Datatables::of($client)->addColumn('action', function ($client) {
                return
                '<div><a  href="' . route('client.edit', $client->id) .'"> <i class="fas fa-edit"></i>
                </a>
                <a  href="' . route('client.show', $client->id) .'"> <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="" class="delete"  data-id="' .$client->id .'"> 
                <i class="fa fa-trash" aria-hidden="true"></i>
                </a>
                
                </div>'
                   
                   ;
            })->make(true);
        } else {

            // $client=Client::select()->where('aprovalID',Auth::user()->user_id)->where('aprovalRole','Receptionist');
            $client= Client::query()->where(function ($query) {
                $query->where('aprovalID', Auth::user()->user_id)->Where('aprovalRole', 'Receptionist');
            });
            return Datatables::of($client)->make(true);
        }
    }

    public function deleteclient($id)
    {
        Registration::find($id)->delete($id);
        return response()->json([

            'success' => 'Record deleted successfully!'

        ]);
    }
    //Show
    public function ClientReservation()
    {
        return view('client.ClientReservation');
    }

    public function ClientReservationData()
    {
        $client= Reservation::with('client');
        if (Auth::user()->hasRole('admin')||Auth::user()->hasRole('manager')) {
            $client=Reservation::query();
            return Datatables::of($client)->make(true);
        } else {
        }
        // return Datatables::of($client)->where($client->client->aprovalID, Auth::user()->user_id)->make(true);
    }
    

    public function acceptClient($email)
    {
        $accepteduser=User ::where('email', $email)->first();
        $accepteduser->update(['role' => "client"]);
        $accepteduser->notify(new WelcomeClient());
       
        $acceptedClient=Registration ::where('email', $email)->first();
      

        $client = new Client;
        $client->name = $acceptedClient->name;
        $client->email = $acceptedClient->email;
        $client->mobile = $acceptedClient->mobile;
        $client->country = $acceptedClient->country;
        $client->gender = $acceptedClient->gender;
        $client->has_reservations = "no";
        $client->aprovalRole = Auth::user()->role;
        $client->aprovalID = Auth::user()->user_id;
        $client->save();
        Registration::where('email', $email)->first()->delete();

        return redirect()->route('Receptionist.ManageClient');
    }
    public function pendedclienthome()
    {
        return view('client.pendedclient');
    }


    public function create()
    {
        $countries = countries();

        return view(
            'client.create',
            ['countries' => $countries]
        );
    }

    public function update($clientId, ClientUpdateRequest  $request)
    {
        $client = Client::find($clientId);
        $requestData= $request->all();
        $client->update($requestData);
        $client->save();
       
        $clientEmail=$client['email'];
        $user=User::where('email', $clientEmail)->first();
        $user->update($requestData);
        $user->save();
        if (Auth::user()->role=="client") {
            return redirect()->route('client.home');
        } else {
            return redirect()->route('Receptionist.ApprovedClient');
        }
    }

    public function edit($clientId)
    {
        $client = Client::find($clientId);
        
        $countries = countries();
        return view('client.edit', [
            'client' => $client,
            'countries' => $countries
        ]);
    }


    public function destroy($clientId)
    {
        $client = Client::findorfail($clientId);
        $user = User::where('email', $client->email)->first();

        $user->delete();
        $client->delete();
        return redirect()->route('Receptionist.ApprovedClient');
    }


    public function store(ClientCreateRequest $request)
    {
        Client::create([
            'name'=> $request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'mobile'=>$request->mobile,
            'country'=>$request->country,
            'aprovalID'=>Auth::user()->user_id,
            'aprovalRole'=>Auth::user()->role,
            'has_reservations'=>$request->has_reservations,
            'avatar_image'=>$request->avatar_image?$request->avatar_image:"avatars/default.png",
            'created_at'=>$request->created_at,
            'updated_at'=>$request->updated_at

        ]);
        $client= Client::where('email', $request->email)->first();

        User::create([
            'name'=> $request->name,
            'email'=>$request->email,
            'password' => Hash::make($request['password']),
            'role'=>'client',
            'user_id'=>$client->id

        ]);

        return redirect()->route('Receptionist.ApprovedClient');
    }
    public function show($clientId)
    {
        $client = Client::find($clientId);
        $user = User::where('user_id', $client->aprovalID)->where('role', $client->aprovalRole)->first();
        
        $countries = countries();
        return view('client.show', [
            'client' => $client,
            'countries' => $countries,
            'user'=>$user,
        ]);
    }
}
