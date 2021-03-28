<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Support\Facades\Hash;
use App\Models\Receptionist;
use Illuminate\Http\Request;
use App\Models\User;

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
        $receptionist = Receptionist::findorfail($ReceptionistId);
        $receptionist->delete();
        return redirect()->route('receptionists.index');
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        Receptionist::create($requestData);
        User::create([
               'name'=> $request->name,
               'email'=>$request->email,
               'role'=>'Reciptionist',

               'password' => Hash::make($request['password']),

           ]);

        return redirect()->route('receptionists.index');
    }
}