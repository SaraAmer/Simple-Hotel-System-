<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FloorsController extends Controller
{
    public function index()
    {
        return view('floors.index');
    }
}
