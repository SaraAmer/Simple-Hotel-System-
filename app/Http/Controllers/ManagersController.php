<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManagerRequest;
use App\Http\Requests\ManagerUpdateRequest;
use App\Models\Floor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Receptionist;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class ManagersController extends Controller
{
    public function index()
    {
        // $allManagers = Manager::all();

     

        
        // return view(
        //     'managers.index',
        //     [

        //     'Managers' => $allManagers,
        // ]
        // );
        return view('managers.index');
    }
    public function getData()
    {
        $manager=Manager::query();
        return Datatables::of($manager)->addColumn('action', function ($manager) {
            return
            '<div><a class="btn btn-success btn-sm"" href="' . route('managers.edit', $manager->id) .'"> <i class="fas fa-edit"></i>
            </a>
            
            <button class="delete"  data-id="' .$manager->id .'"> 
            <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
            </div>'
               
               ;
        })->make(true);
    }
    public function create()
    {
        return view('managers.create');
    }

    public function update($ManagerId, ManagerUpdateRequest  $request)
    {
        $manager = Manager::find($ManagerId);
        // $manageruser=$manageruser->id;
        $requestData= $request->all();
        $manager->update($requestData);
        $manager->save();


        $user=User::where('user_id', $ManagerId)->first();
        $user->update($requestData);
        $user->save();
        return redirect()->route('managers.index');
    }
    public function edit($ManagerId)
    {
        $manager = Manager::find($ManagerId);
       
       
        return view('managers.edit', [
            'manager' => $manager,
            

        ]);
    }

    public function destroy($ManagerId)
    {
        dd("hi");
        $manager = Manager::findorfail($ManagerId);
      
        $user=User::where('email', $manager->email)->first();
   
        $user->delete();
        $manager->delete();
        return response()->json([
            'message' => 'Data deleted successfully!'
          ]);
    }
    public function test()
    {
        dd('hi');
    }

    public function store(ManagerRequest $request)
    {
        // $requestData = $request->all();
        Manager::create([
                'name'=> $request->name,
                'email'=>$request->email,
                'national_id'=>$request->national_id,
                
            ]);
        $manager= Manager::where('email', $request->email)->first();

        User::create([
                'name'=> $request->name,
                'email'=>$request->email,
                'password' => Hash::make($request['password']),
                'role'=>'Manager',
                'user_id'=>$manager->id

            ]);

        return redirect()->route('managers.index');
    }
    public function home()
    {
        $manager = Manager::where('email', Auth::user()->email)->first();
        $receptionist = Receptionist::where('manger_id', $manager->id)->get();
      
        $floors = Floor::where('manger_id', $manager->id)->get();
        
        return view('managers.home', [
            'manager'=> $manager,
            'receptionists' => $receptionist,
            'floors' => $floors,
        ]);
    }
}
