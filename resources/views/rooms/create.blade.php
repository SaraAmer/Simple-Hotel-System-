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
 <h3 class="card-title">create room Info</h3>
 </div>
 <!-- /.card-header -->
 <!-- form start -->
 <form role="form" method="post" action="{{route('rooms.store')}}" enctype="multipart/form-data">
 @csrf
 <div class="card-body">
 
 <div class="form-group">
 <label for="manger_id">Floor Name</label>
 <select name="floor_id" class="form-control" id="floor_id">
 @foreach ($floors as $floor)
 <option value="{{$floor->number}}">{{$floor->name}}</option>
 @endforeach
 </select>
 
 </div>
 <div class="form-group">
 <label for="exampleInputcapacity">Capacity</label>
 <input class="form-control" id="exampleInputcapacity" type="capacity" name="capacity">
 </div>
 
 <div class=" form-group">
 <label for="exampleInputprice_inCents">Price In Cents</label>
 <input class="form-control" id="exampleInputprice_inCents" pattern="[0-9]*" type="text"
 name="price_inCents">
 </div>
 
 <div class="form-group">
 <label for="exampleInputFile">Image Upload</label>
 <br>
 <input id="exampleInputFile" type="file" name="room_image" multiple>
 <p class="help-block">Uploaded Image must be an image with extensions jpg,jpeg.</p>
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