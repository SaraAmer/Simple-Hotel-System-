<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\AUTH;


use App\Models\Floor;
use App\Models\Manager;

class FloorsController extends Controller
{
    public function index()
    {
        $floors = Floor::all();
        return view('floors.index', [
            'floors' =>  $floors,
            'managers' => Manager::all()

        ]);
    }


    public function data()
    {
        if (Auth::user()->hasRole('admin')) {
            return Datatables::of(Floor::all())

            ->addColumn('Manger_name', function ($floor) {
                return $floor->user[0]->name;
            })

            ->addColumn('action', function ($floor) {
                $delUrl = "/floors/" . $floor->number;
                return '<a href="/floors/'.$floor->number.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
            <button  onclick=delFloor("' . $delUrl . '") class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash deleteAjax"  > Delete </i> </button>
          ';
            })
        ->make(true);
        } elseif (Auth::user()->hasRole('manager')) {
            return Datatables::of(Floor::all())

        ->addColumn('Manger_name', function ($floor) {
            return $floor->user[0]->name;
        })
        ->addColumn('action', function ($floor) {
            if (Auth::id()==$floor->created_by) {
                $delUrl = "/floors/" . $floor->number;
                return '<a href="/floors/'.$floor->number.'/edit" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                <button  onclick=delFloor("' . $delUrl . '") class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash deleteAjax"  > Delete </i> </button>
              ';
            }
        })
    ->make(true);
        }
    }

    public function create()
    {
        return view(
            'floors.create'
        );
    }
    public function update($FloorId, Request $request)
    {
        $requestData= $request->all();
        $floors= Floor::find($FloorId);
        $floors->update($requestData);


        $floors->save();
        return redirect()->route('floors.index');
    }
    public function edit($FloorId)
    {
        $floor = Floor::find($FloorId);
        return view('floors.edit', [
            'floor' => $floor,

        ]);
    }

    public function destroy($FloorId)
    {
        $floors = Floor::findorfail($FloorId);
        $floors->delete();
        return redirect()->route('floors.index');
    }

    public function store(Request $request)
    {
        Floor::create([

            'name'=> $request->name,
            'number'=>rand(1, 9999),
            'manger_id'=>Auth::user()->id


        ]);

        return redirect()->route('floors.index');
    }
}
