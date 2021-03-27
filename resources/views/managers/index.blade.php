
@extends('layouts.page')
@section('title')Index Page
@endsection
@section('content')
<a href="{{route('managers.create')}}" class="btn btn-success text-center"  ><i class="ionicons ion-android-create"></i>  Create Manager</a>
<div class="card">
    <div class="card-header">
     <h3 class="card-title">Managers</h3>
    </div>
    <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">ID</th>

                <th>Name</th>
                <th>Email</th>
                <th>Created_at</th>
                <th>Updated at</th>
                <th>Actions</th>

              </tr>
            </thead>
            <tbody>
                @foreach($Managers as $manager)


<br />
<br />
<a href="/managers/create"><button id="new" class="btn btn-success text-center"><i
            class="ionicons ion-android-create"></i> Create Manager</button></a>
<br />
<br />
<table id="users" class="table table-hover table-condensed" style="width:100%">

    <thead>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Actions</th>
        </tr>
    </thead>
    @foreach($Managers as $manager)

    <tr>
        <th scope="row">{{ $manager->id }}</th>
        <td>{{ $manager->name }}</td>
        <td>{{ $manager->email }}</td>
        <td>{{ \Carbon\Carbon::parse( $manager->created_at,'d/m/Y H:i:s')->isoFormat('Y-M-D') }}</td>
        <td>{{ \Carbon\Carbon::parse( $manager->updated_at,'d/m/Y H:i:s')->isoFormat('Y-M-D') }}</td>

        <td>

            <a href="{{route('managers.edit',['manager' => $manager['id']])}}" class="btn btn-secondary"
                style="margin-bottom: 20px;">Edit</a>
            <form style="display:inline" method="POST"
                action="{{route('managers.destroy',['manager' => $manager['id']])}}">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Are you sure?')" class="btn btn-danger" type="submit"
                    style="margin-bottom: 20px;">Delete</button>
            </form>
        </td>
    <tr>
        @endforeach
            </tbody>
          </table>
        </div>
    </div>



  </div>


@endsection




