<?php

namespace App\Http\Controllers;

use App\Models\Receptionist;
use App\Models\User;
use Yajra\Datatables\Datatables;

use Illuminate\Http\Request;

class DatatablesController extends Controller
{
    public function getIndex()
    {
        return view('datatables.index');
    }
    public function anyData()
    {
        $model=User::query();
        return Datatables::of($model)->addColumn('action', function ($arrProduct) {
            return
                '<a class="btn btn-success btn-sm""> Edit
                   </a>
                   <a class="btn btn-success btn-sm""> Edit
                   </a>
                   '
                   ;
        })->make(true);
    }
}
