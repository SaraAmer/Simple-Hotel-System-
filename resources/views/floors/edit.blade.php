@extends('layouts.page')
@section('title')Edit
@endsection
@section('content')
<div class="container">
<<<<<<< HEAD
  <div class="container-fluid">
=======
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
>>>>>>> e72fb3b8289d441e1adfdb8c15be0b04b054ec7a

    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Floor Info Page</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" method="POST" action="{{route('floors.update',['floor' => $floor['number']])}}"
        enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input class="form-control" id="exampleInputName" type="text" name="name" value="{{ $floor['name'] }}">
          </div>
<<<<<<< HEAD
=======
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" method="POST" action="{{route('floors.update',['floor' => $floor['number']])}}"  enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputName">Name</label>
                  <input class="form-control" id="exampleInputName"  type="text" name="name" value="{{ $floor['name'] }}">
              </div>
>>>>>>> e72fb3b8289d441e1adfdb8c15be0b04b054ec7a

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>


  @endsection