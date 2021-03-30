@extends('layouts.page')

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
        <h3 class="card-title">Edit room Info Page</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" method="post" action="{{route('rooms.update',['room'=> $room['room_number']])}}"
        enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputfloor_id">Floor id</label>
            <input class="form-control" id="exampleInputfloor_id" type="text" name="floor_id" value="{{ $room['floor_id'] }}">

          </div>
          <div class="form-group">
            <label for="exampleInputcapacity">Capacity</label>
            <input class="form-control" id="exampleInputcapacity" type="capacity" name="capacity"
              value="{{ $room['capacity'] }}">
          </div>


          <div class=" form-group">
            <label for="exampleInputprice_inCents">Price In Cents</label>
            <input class="form-control" id="exampleInputprice_inCents" pattern="[0-9]*" type="text" name="price_inCents"
              value="{{ $room['price_inCents'] }}">
            <div class="form-group">
              <label>Profile Image</label>
              <br />
              <img src="{{asset( $room['avatar_image'] )}}" width="100" heigth="100" />
              <br />
              <label for="exampleInputFile"> Upload New Image Profile</label>
              <br>
              <input id="exampleInputFile" type="file" name="avatar_image" multiple>
              <p class="help-block">Uploaded Image must be an image with extensions jpg,jpeg.</p>
            </div>

          </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>


  @endsection