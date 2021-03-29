<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FloorsController extends Controller
{
    public function index()
    {
        return view('floors.index');
    }
    public function create()
    {
        return view('floors.create');
    }
}
