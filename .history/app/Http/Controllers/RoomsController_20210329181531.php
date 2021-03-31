<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class RoomsController extends Controller
{
    public function index()
    {
        $allrooms = room::all();

     

        
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

    public function update($roomId, roomUpdateRequest  $request)
    {
        $room = room::find($roomId);
        
    
        // $roomuser=$roomuser->id;
       
        $requestData= $request->all();
        $room->update($requestData);
        $room->save();
        return redirect()->route('rooms.index');
    }
    public function edit($roomId)
    {
        $room = room::find($roomId);
       
       
        return view('rooms.edit', [
            'room' => $room,
            

        ]);
    }

    public function destroy($roomId)
    {
        $room = room::findorfail($roomId);
        User::where('email', $room->email)->delete();
        $room->delete();
        return redirect()->route('rooms.index');
    }

    public function store(roomRequest $request)
    {
        // $requestData = $request->all();
        room::create([
                'name'=> $request->name,
                'email'=>$request->email,
                'national_id'=>$request->national_id,
                
            ]);
        $room= room::where('email', $request->email)->first();

        User::create([
                'name'=> $request->name,
                'email'=>$request->email,
                'password' => Hash::make($request['password']),
                'role'=>'room',
                'user_id'=>$room->id

            ]);

        return redirect()->route('rooms.index');
    }
}

