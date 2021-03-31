<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\AUTH;
use App\Models\Room;

use App\Models\Floor;
use App\Models\Manager;

class FloorsController extends Controller
{
    public function index()
    {
        $floors = Floor::all();
        return view('floors.index', [
            'floors' =>  $floors,
            'managers' => Manager::all()

        ]);
    }
    public function create()
    {
        return view(
            'floors.create'
        );
    }
    public function update($FloorId, Request $request)
    {
        $floors=  Floor::where("number", $FloorId)->first();
        Floor::where("number", $FloorId)->update($request->except(['_method', '_token']));
        $floors->save();
        return redirect()->route('floors.index');
    }
    public function edit($FloorId)
    {
        $floor = Floor::where("number", $FloorId)->first();
        return view('floors.edit', [
            'floor' => $floor,

        ]);
    }

    public function destroy(Floor $floorId)
    {
        $floors=Floor::findorfail($floorId);

        $room=Room::where('floor_id', $floors->floor_id)->first();
        $floors->delete();
        $room->delete();

        return redirect()->route('floors.index');
    }

    public function store(Request $request)
    {
        Floor::create([

            'name'=> $request->name,
            'number'=>rand(1, 9999),
            'manger_id'=>Auth::user()->id


        ]);

        return redirect()->route('floors.index');
    }
}
