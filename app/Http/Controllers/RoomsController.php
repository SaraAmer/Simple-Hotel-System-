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
            $priceInDollars[]= $room->price_inCents *0.01;
        }
        //dd($priceInDollars);
        //dd($priceInDollars);

        //  $priceInCents = $allrooms->map(function ($allrooms) {
        //     return collect($allrooms->toArray())
        //         ->only(['price_inCents'])
        //         ->all();
        //      });
        //     dd($priceInCents);


        // $priceInCents= Room::all('price_inCents');
        // dd($priceInCents);

        // $priceInDollars=money_format('$%i', ($priceInCents / 100);
        //  dd($priceInDollars);
        //     $allfloors=[];
        //   foreach ( $allrooms as $room ){
        //     $allfloors[]=Floor::all()->where('number','=',$room->floor_id);}
            // $allfloors=Floor::all()

            // dd($allfloors);
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
        
        return view('rooms.create', [
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
        Room::create($requestData);

        return redirect()->route('rooms.index');
    }
}