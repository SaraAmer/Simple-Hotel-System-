@extends('layouts.page')
@section('title')Manage Floors
@endsection
@section('content')
 <a href="{{route('floors.create')}}" class="btn btn-success text-center"  ><i class="ionicons ion-android-create"></i>  Create Floors</a>
 <div class="card">
    <div class="card-header">
     <h3 class="card-title">Floors</h3>
    </div>
    <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
            <th>Name</th>
            <th>Number</th>
            @role('admin')
            <th>Manager Name</th>
            @endrole
            <th>Actions</th>
           </tr>
           </thead>
    @foreach($floors as $floor)

    <tr>
        <th scope="row">{{ $floor->name }}</th>
        <td>{{ $floor->number }}</td>
        @role('admin')
        <td>{{

          $floor->manager ? $floor->manager->name : 'Admin'
          }}

        </td>
        @endrole
        <td>
            {{-- mfrod tban ly el manager bs ely 3aml create ly el sf7a dih  --}}
            <a href="{{route('floors.edit',['floor' => $floor['number']])}}" class="btn btn-secondary" style="margin-bottom: 20px;">Edit</a>
            <form style="display:inline" method="POST"
                action="{{route('floors.destroy',['floor' => $floor['number']])}}">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Are you sure?')" class="btn btn-danger" type="submit"
                    style="margin-bottom: 20px;">Delete</button>
            </form>
        </td>
    </tr>
        @endforeach

          </table>
        </div>
    </div>
@endsection
