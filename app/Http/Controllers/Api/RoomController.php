<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RoomResource;

class RoomController extends Controller
{
    public function index()
    {
        dd("we are in index");
        // $allrooms = Room::all();
        // return RoomResource::collection($allrooms);
    }
}
