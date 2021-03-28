<?php

namespace App\Http\Controllers;

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

    public function update($ManagerId, Request $request)
    {
        $requestData= $request->all();
        $manager = Manager::find($ManagerId);
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
        $manager->delete();
        return redirect()->route('managers.index');
    }

    public function store(Request $request)
    {
        // $requestData = $request->all();
        Manager::create([
                'name'=> $request->name,
                'email'=>$request->email,
                'national_id'=>$request->national_id,
                
            ]);
        User::create([
                'name'=> $request->name,
                'email'=>$request->email,
                'password' => Hash::make($request['password']),
                'role'=>'Manager',

            ]);

        return redirect()->route('managers.index');
    }
    public function profile()
    {
        // $manager= new Manager();
        $email=Auth::user()->email;
        $manager=Manager::where('email', $email)->get();
        dd($manager);
        return view('profile', ['manager'=>$manager]);
    }
}
