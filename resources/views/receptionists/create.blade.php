@extends('layouts.app')

@section('content')



<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create New Receptionist Page</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="/receptioists" enctype="multipart/form-data">
            @csrf
              <div class="box-body">
              <div class="form-group">
                  <label for="exampleInputName">Name</label>
                  <input class="form-control" id="exampleInputName" placeholder="Enter Receptionist's Name" type="text" name="name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input class="form-control" id="exampleInputEmail1" placeholder="Enter email" type="email" name="email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input class="form-control" id="exampleInputPassword1" placeholder="Password" type="password" name="password">
                </div>
                <div class="form-group">
                  <label for="exampleInputNationalID">National ID</label>
                   <input id="exampleInputNationalId" pattern="[0-9]*" class="form-control" placeholder="Enter national id" type="text" name="national_id"/>
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

@endsection
