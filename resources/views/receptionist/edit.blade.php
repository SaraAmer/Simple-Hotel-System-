@extends('layouts.page')
@section('title')Edit
@endsection
@section('content')
<div class="container">
  <div class="container-fluid">
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Receptionist Info Page</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" method="post" action="{{route('receptionists.update',['receptionist' => $receptionist['id']])}}"
        enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input class="form-control" id="exampleInputName" type="text" name="name"
              value="{{ $receptionist['name'] }}">

          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="exampleInputEmail1" type="email" name="email"
              value="{{ $receptionist['email'] }}">
          </div>
          <div class="form-group">
            <label for="manger_id">Manager</label>
            <select name="manger_id" class="form-control" id="manger_id">
              @foreach ($managers as $manager)
              <option value="{{$manager->id}}">{{$manager->name}}</option>
              @endforeach
            </select>
          </div>


          <div class="form-group">
            <label for="exampleInputNationalID">National ID</label>
            <input class="form-control" id="exampleInputNationalID" pattern="[0-9]*" type="text" name="national_id"
              value="{{ $receptionist['national_id'] }}">
            <div class="form-group">
              <label>Profile Image</label>
              <br />
              <img src="{{asset($receptionist['avatar_image'])}}" width="100" heigth="100" />
              <br />
              
            </div>

            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
      </form>
    </div>
  </div>


  @endsection