<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\AUTH;
use App\Models\Room;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\FloorCreateRequest; 
use App\Http\Requests\FloorUpdateRequest;

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
    public function update($FloorId, FloorUpdateRequest $request)
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

    public function destroy($floorId)
    {
        $Floor=Floor::where('number', $floorId)->first();


        $room=Room::where('floor_id', $floorId)->first();
        if ($room==null) {
            Floor::where('number', $floorId)->delete();
        } else {
            Session::flash('message', "Floor rooms are not empty it can't be deleted!");
        }
        return redirect()->route('floors.index');
    }

    public function store(FloorCreateRequest $request)
    {
        // $manager = Manager::where('email', Auth::user()->email)->first();

        Floor::create([

            'name'=> $request->name,
            'number'=>rand(1, 9999),
            'manger_id'=>Auth::user()->user_id,


        ]);

        return redirect()->route('floors.index');
    }
}
