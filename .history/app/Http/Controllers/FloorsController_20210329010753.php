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


        $receptionist->save();
        return redirect()->route('receptionists.index');
    }
}
