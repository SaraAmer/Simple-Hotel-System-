<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Floor;

class FloorsController extends Controller
{
    public function index()
    {
        $allFloors = Floor::all();
        return view('floors.index', [
            'floors' =>  $allFloors,
            'managers' => Manager::all()

        ]);
    }
    public function create()
    {
        return view('floors.create', [
            'managers' => Manager::all()
        ]);
    }
    public function update($FloorId, Request $request)
    {
        $requestData= $request->all();
        $floors= Floor::find($FloorId);
        $floors->update($requestData);


        $floors->save();
        return redirect()->route('floors.index');
    }
    public function edit($FloorId)
    {
        $floors = Floor::find($FloorId);
        return view('receptionists.edit', [
            'floors' => $floors,
            'managers' => Manager::all()
        ]);
    }

    public function destroy($FloorId)
    {
        $floors = Floor::findorfail($FloorId);
        $floors->delete();
        return redirect()->route('floors.index');
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        Floor::create($requestData);
        User::create([
               'name'=> $request->name,
               'email'=>$request->email,
               'password' => Hash::make($request['password']),
               'role' => 'Receptionist'

           ]);

        return redirect()->route('floors.index');
    }
}
