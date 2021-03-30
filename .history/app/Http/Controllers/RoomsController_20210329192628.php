<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Room;
use App\Models\User;

class RoomsController extends Controller
{
    public function index()
    {
        $allrooms = Room::all();

        return view(
            'rooms.index',
            [

            'rooms' => $allrooms,
        ]
        );
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function update($roomId, Request  $request)
    {
        $room = Room::find($roomId);
        $roomuser=$roomuser->id;
         $requestData= $request->all();
        $room->update($requestData);
        $room->save();
        return redirect()->route('rooms.index');
    }
    public function edit($roomId)
    {
        $room = Room::find($roomId);
    
        return view('rooms.edit', [
            'room' => $room,

        ]);
    }

    public function destroy($roomId)
    {
        $room = Room::findorfail($roomId);
        // $room->delete();
        return redirect()->route('rooms.index');
    }

    public function store(Request $request)
    {
        // $requestData = $request->all();
        Room::create([
                'name'=> $request->name,
                'email'=>$request->email,
                'national_id'=>$request->national_id,
                
            ]);
        $room= Room::where('email', $request->email)->first();

        return redirect()->route('rooms.index');
    }
}

