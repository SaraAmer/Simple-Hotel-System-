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
            <h3 class="card-title">Edit client Page</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" method="POST" action="{{route('client.update',['client' => $client['id']])}}"  enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputName">Name</label>
                  <input class="form-control" id="exampleInputName"  type="text" name="name" value="{{ $client['name'] }}">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input class="form-control" id="exampleInputName" type="email" name="email"
                  value="{{ $client['email'] }}">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Mobile</label>
                <input class="form-control" id="exampleInputEmail1" type="mobile" name="mobile"
                  value="{{ $client['mobile'] }}">
                </div>



              <div class="form-group">
                <label>Profile Image</label>
                <br />
                <img src="{{asset( $client['avatar_image'] )}}" width="100" heigth="100" />
                <br />
                <label for="exampleInputFile"> Upload New Image Profile</label>
                <br>
                <input id="exampleInputFile" type="file" name="avatar_image" multiple>
                <p class="help-block">Uploaded Image must be an image with extensions jpg,jpeg.</p>
              </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
    </div>


@endsection


