<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Floor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        return view('floors.create');
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
        return view('floors.edit', [
            'floors' => $floors,

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

        Floor::create([
            'name'=> $request->name,
            'number'=>rand(1, 9999),

        ]);

        return redirect()->route('floors.index');
    }
}
