<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManagerRequest;
use App\Http\Requests\ManagerUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ManagersController extends Controller
{
    public function index()
    {
        $allManagers = Manager::all();

     

        
        return view(
            'managers.index',
            [

            'Managers' => $allManagers,
        ]
        );
    }

    public function create()
    {
        return view('managers.create');
    }

    public function update($ManagerId, ManagerUpdateRequest  $request)
    {
        $manager = Manager::find($ManagerId);
        $requestData= $request->all();
        $manager->update($requestData);
        $manager->save();
        return redirect()->route('managers.index');
    }
    public function edit($ManagerId)
    {
        $manager = Manager::find($ManagerId);
       
       
        return view('managers.edit', [
            'manager' => $manager,
            

        ]);
    }

    public function destroy($ManagerId)
    {
        $manager = Manager::findorfail($ManagerId);
        User::where('email', $manager->email)->delete();
        $manager->delete();
        return redirect()->route('managers.index');
    }

    public function store(ManagerRequest $request)
    {
        // $requestData = $request->all();
        Manager::create([
                'name'=> $request->name,
                'email'=>$request->email,
                'national_id'=>$request->national_id,
                
            ]);
        $manager= Manager::where('email', $request->email)->first();

        User::create([
                'name'=> $request->name,
                'email'=>$request->email,
                'password' => Hash::make($request['password']),
                'role'=>'Manager',
                'user_id'=>$manager->id

            ]);

        return redirect()->route('managers.index');
    }
}
