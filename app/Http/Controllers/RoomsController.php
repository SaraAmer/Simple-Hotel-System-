<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Room;
use App\Models\User;
use App\Models\Floor;

class RoomsController extends Controller
{
    public function index()
    {
        $allrooms = Room::all();

        $priceInDollars=[];
        foreach ($allrooms as $room) {
            $priceInDollars[]= $room->price *0.01;
        }
        
        return view(
            'rooms.index',
            [

            'rooms' => $allrooms,
            'priceInDollars'=>$priceInDollars,
            'floors'=>Floor::all(),

        ]
        );
    }

    public function create()
    {
        return view(
            'rooms.create',
            [
            'floors'=>Floor::all(),
            ]
        );
    }

    public function update($roomId, Request  $request)
    {
        $requestData= $request->except(['_token', '_method' ]);
        $room= Room::where('room_number', $roomId)->first();
        Room::where('room_number', $roomId)
                  ->update($requestData);
        $room->save();
        return redirect()->route('rooms.index');
    }
    public function edit($roomId)
    {
        $room= Room::where('room_number', $roomId)->first();
        return view('rooms.edit', [
            'room' => $room,

        ]);
    }

    public function destroy($roomId)
    {
        Room::where('room_number', $roomId)
                  ->delete();
        return redirect()->route('rooms.index');
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        
        Room::create([
            'floor_id'=> $request->floor_id,
            'capacity'=>$request->capacity,
            'price' => $request->price_inCents,
           

        ]);

        return redirect()->route('rooms.index');
    }
    public function showAvailabe()
    {
        $rooms= Room::where('status', 'available')->get();
       
        return view('rooms.showAvailable', [
            'rooms' => $rooms,
        ]);
    }
}
