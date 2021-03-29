<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
