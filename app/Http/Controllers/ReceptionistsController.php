<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceptionistsController extends Controller
{
        //Display All Receptionists
        public function index()
        {
           return view('receptionists.index');
        }
        public function create()
        {
            return view('receptionists.create');
        }
    
        public function edit()
        {
            return view('receptionists.edit');
        }
    
        public function destroy($receptionistId){
    
            // $receptionist = POST::findorfail($receptionistId);
    
            // $receptionist->delete();
            return redirect()->route('receptionists.index');
            
            }
}
