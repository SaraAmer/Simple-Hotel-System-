@extends('layouts.page')
@section('title')Create
@endsection
@section('content')
<div class="container">
  <div class="container-fluid">

    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create New Client </h3>
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

      <form role="form" method="post" action="{{route('client.store')}}" enctype="multipart/form-data">

        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input class="form-control" id="exampleInputName" placeholder="Enter Client Name" type="text" name="name"
              value="{{ old('name') }}">

          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="exampleInputEmail1" placeholder="Enter email" type="email" name="email"
              value="{{ old('email') }}">
          </div>
          <div class="form-group">
            <label for="exampleInputMobile">Mobile phone</label>
            <input class="form-control" id="exampleInputMobile" placeholder="Enter Mobile" type="mobile" name="mobile"
              value="{{ old('mobile') }}">

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

            <label for="exampleInputGender">Gender</label>
            <select name="gender" class="custom-select custom-select-lg mb-3">

              <option value="Female">Female</option>
              <option value="Male">Male</option>

            </select>

          </div>


          <div class="form-group">
            <label for="exampleInputRes">Does this client has reservation?</label>
            <select name="has_reservations" class="custom-select custom-select-lg mb-3">
              <option value="no">No</option>
              <option value="yes">Yes</option>

            </select>

          </div>

          <div class="form-group">
            <label for="exampleInputCountry">Country</label>
            <select name="country" class="form-control @error('countries') is-invalid @enderror">

              @foreach($countries as $country)
              {
              <option value="{{$country['name']}}">{{$country['name']}}</option>
              }

              @endforeach

            </select>


            @error('countries')
            <span class="form-control @error('countries') is-invalid @enderror" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>




          <div class="form-group">
            <label for="exampleInputFile">Image Upload</label>
            <br>
            <input id="exampleInputFile" type="file" name="avatar_image" multiple>
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