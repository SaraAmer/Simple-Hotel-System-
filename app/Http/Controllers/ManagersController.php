<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManagerCreateRequest;
use App\Http\Requests\ManagerUpdateRequest;
use App\Models\Floor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Receptionist;
use App\Models\Room;
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

    public function show($managerId)
    {
        $manager = Manager::find($managerId);

        return view('managers.show', [
            'manager' => $manager,
        ]);
    }


    public function create()
    {
        return view('managers.create');
    }

    public function update($ManagerId, ManagerUpdateRequest  $request)
    {
        $manager = Manager::find($ManagerId);
        // $manageruser=$manageruser->id;
        $requestData = $request->all();
        $manager->update($requestData);
        $manager->save();

        $managerEmail=$manager['email'];
        $user = User::where('email', $managerEmail)->first();
        $user->update($requestData);
        $user->save();
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

        $user = User::where('email', $manager->email)->first();

        $user->delete();
        $manager->delete();
        return redirect()->route('managers.index');
    }

    public function store(ManagerCreateRequest $request)
    {
        // $requestData = $request->all();
        Manager::create([
            'name' => $request->name,
            'email' => $request->email,
            'national_id' => $request->national_id,

        ]);
        $manager = Manager::where('email', $request->email)->first();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
            'role' => 'Manager',
            'user_id' => $manager->id

        ]);

        return redirect()->route('managers.index');
    }

    public function home()
    {
        $manager = Manager::where('email', Auth::user()->email)->first();
        $receptionist = Receptionist::where('manger_id', $manager->id)->get();

        $floors = Floor::where('manger_id', $manager->id)->get();

        return view('managers.home', [
            'manager'=> $manager,
            'receptionists' => $receptionist,
            'floors' => $floors,
        ]);
    }
}
