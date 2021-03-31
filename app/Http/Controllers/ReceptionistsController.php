<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Support\Facades\Hash;
use App\Models\Receptionist;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\AUTH;

class ReceptionistsController extends Controller
{
    //Display All Receptionists
    public function index()
    {
        $allReceptionist = Receptionist::all();
        
        return view(
            'receptionists.index',
            [
                'Receptionist' =>  $allReceptionist,
                'managers' => Manager::all()
                
            ]
        );
    }
    public function create()
    {
        return view('receptionists.create', [
            'managers' => Manager::all()
        ]);
    }
    public function update($ReceptionistId, Request $request)
    {
        $requestData= $request->all();
        $receptionist= Receptionist::find($ReceptionistId);
        $receptionist->update($requestData);


        $receptionist->save();
        return redirect()->route('receptionists.index');
    }

    public function edit($ReceptionistId)
    {
        $receptionist = Receptionist::find($ReceptionistId);
        return view('receptionists.edit', [
            'receptionist' => $receptionist,
            'managers' => Manager::all()
        ]);
    }

    public function destroy($ReceptionistId)
    {
        $receptionist=Receptionist::findorfail($ReceptionistId);
      
        $user=User::where('email', $receptionist->email)->first();
   
         $user->delete();
         $receptionist->delete();
         return redirect()->route('receptionists.index');
    }

    public function store(Request $request)
    {
      
       Receptionist::create([
            'name'=> $request->name,
            'email'=>$request->email,
            'national_id'=>$request->national_id,
            'manger_id'=>Auth::user()->id
            
        ]);
       $receptionist= Receptionist::where('email', $request->email)->first();

     User::create([
            'name'=> $request->name,
            'email'=>$request->email,
            'password' => Hash::make($request['password']),
            'role'=>'Receptionist',
            'user_id'=>$receptionist->id

        ]);

        return redirect()->route('receptionists.index');
    }
    public function ban($ReceptionistId)
    {
        $user = User::where('user_id', $ReceptionistId)->where('role', 'Receptionist')->first();
        $receptionist = Receptionist::where('id', $ReceptionistId)->first();
        $receptionist->ban();
        $user->ban();
        return redirect()->route('receptionists.index');
    }
    public function unban($ReceptionistId)
    {
        $user = User::where('user_id', $ReceptionistId)->where('role', 'Receptionist')->first();
        $receptionist = Receptionist::where('id', $ReceptionistId)->first();
        $receptionist->unban();
        $user->unban();
        return redirect()->route('receptionists.index');
    }
    function profile() 
    {
        $Receptionist= Receptionist  :: where('id',1)->first();
        //Check on Email get from url which i can  get using parameter input as it's different from one to another 
        // $Receptionist= Receptionist  :: where('email',)->first();

        // @dd($Receptionist);
        return view('receptionists/ProfileReceptionist',['Receptionist'=> $Receptionist]);

    }
}
