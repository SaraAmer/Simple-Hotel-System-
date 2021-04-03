<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Reciptionist;
use App\Http\Requests\ReceptionistCreateRequest;
use App\Http\Requests\ReceptionistUpdateRequest;
use App\Models\Manager;
use Illuminate\Support\Facades\Hash;
use App\Models\Receptionist;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\AUTH;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;

class ReceptionistsController extends Controller
{
    //Display All Receptionists
    public function index()
    {
        return view('receptionist.index');
    }
    public function getData()
    {
        $receptionist=Receptionist::with(['manager']);
      
        return Datatables::of($receptionist) ->addColumn('managers', function (Receptionist $receptionist) {
            if (Auth::user()->role=='Admin') {
                return empty($receptionist->manager->name) ? $receptionist->manager->name : $receptionist->manager->name;
            } else {
            }
        })->addColumn('action', function ($receptionist) {
            return
            '<div><a  href="' . route('receptionists.edit', $receptionist->id) .'"> <i class="fas fa-edit"></i>
            </a>
            <a  href="' . route('receptionists.show', $receptionist->id) .'"> <i class="fa fa-eye" aria-hidden="true"></i>
            </a>
            <a href="" class="delete"  data-id="' . $receptionist->id .'"> 
            <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
            
            </div>'
               
               ;
        })->editColumn('created_at', function ($request) {
            return $request->created_at->format('Y-m-d');
        }) ->editColumn('updated_at', function ($request) {
            return $request->updated_at->format('Y-m-d');
        })
        ->make(true);
    }
    public function create()
    {
        return view('receptionist.create', [
            'manager' => Manager::all()
        ]);
    }
    public function update($ReceptionistId, ReceptionistUpdateRequest $request)
    {
        $requestData= $request->all();
        $receptionist= Receptionist::find($ReceptionistId);
        $receptionist->update($requestData);
        $receptionist->save();

        $user=User::where('user_id', $ReceptionistId)->first();
        $user->update($requestData);
        $user->save();
        return redirect()->route('receptionists.index');
    }


    public function edit($ReceptionistId)
    {
        $receptionist = Receptionist::find($ReceptionistId);
        return view('receptionist.edit', [
            'receptionist' => $receptionist,
            'managers' => Manager::all()
        ]);
    }

    public function destroy($ReceptionistId)
    {
        $receptionist=Receptionist::find($ReceptionistId);

        $user=User::where('email', $receptionist->email)->first();

        $user->delete();
        $receptionist->delete();
        return response()->json([
            'message' => 'Data deleted successfully!'
          ]);
    }

    public function store(ReceptionistCreateRequest $request)
    {
        $file = $request->file('avatar_image');
    
        
        $manager = User::where('email', Auth::user()->email)->first();
        
        $name=time().$request->file('avatar_image')->getClientOriginalName();
       
        $file->move('avatars', $name);

        Receptionist::create([
            'name'=> $request->name,
            'email'=>$request->email,
            'national_id'=>$request->national_id,
            'manger_id'=> $manager->user_id,
            'avatar_image'=>"avatars/".$name,
        ]);
        $receptionist= Receptionist::where('email', $request->email)->first();

        User::create([
            'name'=> $request->name,
            'email'=>$request->email,
            'password' => Hash::make($request['password']),
            'role'=>'Receptionist',
            'user_id'=>$receptionist->id

        ]);

        return redirect()->route('receptionists.index');
    }
    public function ban($ReceptionistId)
    {
        $user = User::where('user_id', $ReceptionistId)->where('role', 'Receptionist')->first();
        $receptionist = Receptionist::where('id', $ReceptionistId)->first();
        $receptionist->ban();
        $user->ban();
        return redirect()->route('receptionists.index');
    }
    public function unban($ReceptionistId)
    {
        $user = User::where('user_id', $ReceptionistId)->where('role', 'Receptionist')->first();
        $receptionist = Receptionist::where('id', $ReceptionistId)->first();
        $receptionist->unban();
        $user->unban();
        return redirect()->route('receptionists.index');
    }
    public function home()
    {
        if (!Auth::user()->hasRole('receptionist')) {
            Auth::user()->assignRole('receptionist');
        }
        $receptionist = Receptionist::where('email', Auth::user()->email)->first();
       
        return view('receptionist.home', [
            'Receptionist' => $receptionist
        ]);
        function profile()
        {
            $Receptionist= Receptionist  :: where('id', 1)->first();
            //Check on Email get from url which i can  get using parameter input as it's different from one to another
            // $Receptionist= Receptionist  :: where('email',)->first();

            // @dd($Receptionist);
            return view('receptionist/home', ['Receptionist'=> $Receptionist]);
        }
    }
    public function show($receptionistId)
    {
        $receptionist = Receptionist :: find($receptionistId); //object of Post model

        return view('receptionist.show', [
            'receptionist' => $receptionist,
        ]);
    }
}
