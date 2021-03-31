@extends('layouts.page')
@section('title')Manage Receptionists
@endsection
@section('content')
<a href="{{route('receptionists.create')}}" class="btn btn-success text-center"><i
    class="ionicons ion-android-create"></i> Create Receptionist</a>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Receptionists</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">

    <table id="example2" class="table table-bordered table-hover display" style="width:100%">


        <thead>
        <tr>
          <th style="width: 10px">ID</th>

          <th>Name</th>
          <th>Email</th>
          <th>Created_at</th>
          <th>Updated at</th>
          @role('admin')
          <th>Manager Name</th>
          @endrole
          <th>Actions</th>

        </tr>
      </thead>
      <tbody>
        @foreach($Receptionist as $receptionist)
        <tr>
          <th scope="row">{{ $receptionist->id }}</th>
          <td>{{ $receptionist->name }}</td>
          <td>{{ $receptionist->email }}</td>
          <td>{{ \Carbon\Carbon::parse( $receptionist->created_at,'d/m/Y H:i:s')->isoFormat('Y-M-D') }}</td>
          <td>{{ \Carbon\Carbon::parse( $receptionist->updated_at,'d/m/Y H:i:s')->isoFormat('Y-M-D') }}</td>
          @role('admin')
          <td>{{

            $receptionist->manager ? $receptionist->manager->name : 'By admin'
            }}

          </td>
          @endrole
          <td>

            <a href="{{route('receptionists.edit',['receptionist' => $receptionist['id']])}}" class="btn btn-secondary"
              style="margin-bottom: 20px;">Edit</a>
            <form style="display:inline" method="POST"
              action="{{route('receptionists.destroy',['receptionist' => $receptionist['id']])}}">
              @csrf
              @method('DELETE')
              <button onclick="return confirm('Are you sure?')" class="btn btn-danger" type="submit"
                style="margin-bottom: 20px;">Delete</button>
            </form>
          </td>
        </tr>
          @endforeach
      </tbody>
    </table>
  </div>




@endsection
