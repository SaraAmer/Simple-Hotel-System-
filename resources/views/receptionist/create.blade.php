@extends('layouts.page')
@section('title')Create
@endsection
@section('content')
<div class="container">
  <div class="container-fluid">

    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create New Receptionist Page</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <form role="form" method="post" action="{{route('receptionists.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input class="form-control" id="exampleInputName" placeholder="Enter Receptionist Name" type="text"
              name="name" value="{{ old('name') }}">

          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="exampleInputEmail1" placeholder="Enter email" type="email" name="email"
              value="{{ old('email') }}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" placeholder="Password" type="password"
              name="password">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input class="form-control" placeholder="Re-write Password" type="password" name="password_confirmation">
          </div>

          <div class="form-group">
            <label for="exampleInputNationalID">National ID</label>
            <input class="form-control" id="exampleInputNationalID" pattern="[0-9]*" type="text" name="national_id"
              placeholder="National ID" value="{{ old('national_id') }}">
          </div>


          <div class="form-group">
            <input type="file" name="avatar_image" multiple>
            <p class="help-block">Uploaded Image must be an image with extensions jpg,jpeg.</p>
          </div>


        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Create</button>
        </div>
      </form>
    </div>
  </div>


  @endsection