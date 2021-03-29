@extends('layouts.page')
@section('title')Edit
@endsection
@section('content')
<div class="container">
<div class="container-fluid">

        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit Floor Info Page</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" method="post" action="{{route('floors.update',['floors' => $floor['id']])}}"  enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputName">Name</label>
                  <input class="form-control" id="exampleInputName"  type="text" name="name" placeholder="{{ $receptionist['name'] }}">




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


