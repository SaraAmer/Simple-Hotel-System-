@extends('layouts.page')
@section('title')Create
@endsection
@section('content')
<div class="container">
<div class="container-fluid">

        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Create New Floor </h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" method="post" action="{{route('floors.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputName">Name</label>
                  <input class="form-control" id="exampleInputName" placeholder="Enter Floor Name" type="text" name="name">

              <div class="form-group">
                <label for="manger_id">Manager</label>
                <select name="manger_id" class="form-control" id="manger_id">
                  @foreach ($managers as $manager)
                    <option value="{{$manager->id}}">{{$manager->name}}</option>
                  @endforeach
                </select>
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


