@extends('layouts.page')
@section('title')edit
@endsection

@section('content')
<div class="container">
<div class="container-fluid">

        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Manager Info Page</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" method="post" action="{{route('managers.update',['manager'=> $manager['id']])}}"  enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputName">Name</label>
                  <input class="form-control" id="exampleInputName"  type="text" name="name" placeholder="{{ $manager['name'] }}">

              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input class="form-control" id="exampleInputEmail1" type="email" name="email" placeholder="{{ $manager['email'] }}" >
              </div>

              <div class="form-group">
                <label for="exampleInputNationalID">National ID</label>
                <input class="form-control" id="exampleInputNationalID" pattern="[0-9]*" type="text" name="national_id" placeholder="{{ $manager['national_id'] }}">
                <div class="form-group">
                    <label>Profile Image</label>
                    <br/>
                    <img src="" width="100" heigth="100"/>
                    <br/>
                      <label for="exampleInputFile"> Upload New Image Profile</label>
                      <br>
                      <input id="exampleInputFile" type="file" name="avatar_image" multiple>
                      <p class="help-block">Uploaded Image must be an image with extensions jpg,jpeg.</p>
                    </div>

              </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Edit</button>
            </div>
          </form>
        </div>
    </div>


@endsection


