@extends('layouts.page')
@section('title')create
@endsection

@section('content')
<div class="container">
  <div class="container-fluid">




    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Create New Manager Page</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" method="post" action="{{route('managers.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
          <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input class="form-control" id="exampleInputName" placeholder="Enter Manager Name" type="text" name="name">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="exampleInputEmail1" placeholder="Enter email" type="email" name="email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" placeholder="Password" type="password"
              name="password">
          </div>
          <div class="form-group">
            <label for="exampleInputNationalID">National ID</label>
            <input id="exampleInputNationalId" pattern="[0-9]*" class="form-control" placeholder="Enter national id"
              type="text" name="national_id" />
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Image Upload</label>
            <br>
            <input id="exampleInputFile" type="file" name="avatar_image" multiple>
            <p class="help-block">Uploaded Image must be an image with extensions jpg,jpeg.</p>
          </div>
        </div>
        <!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>



    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create New Manager Page</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" method="post" action="{{route('managers.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input class="form-control" id="exampleInputName" placeholder="Enter Manager Name" type="text" name="name">

          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="exampleInputEmail1" placeholder="Enter email" type="email" name="email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" placeholder="Password" type="password"
              name="password">
          </div>

          <div class="form-group">
            <label for="exampleInputNationalID">National ID</label>
            <input class="form-control" id="exampleInputNationalID" pattern="[0-9]*" type="text" name="national_id">
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Image Upload</label>
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
