<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if(Auth::user()->role=="pended client"){
        //     return Redirect::route('client.pendedclient');
           
        // }
        // else{
        $current_user_role=Str::lower(Auth::user()->role);
        // // // return redirect("/".$current_user_role."/home");
        return Redirect::route($current_user_role .".home");
        // }
        // return view("home");
    }
}
