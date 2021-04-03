@extends('layouts.page')
@section('title')Index Page
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h4 class="card-title"> Your Profile</h4>
    </div>

  
    <!-- Main content -->
 
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">Browse Our Rooms</h4>
              </div>
              <div class="card-body">
                <div>
          
                  
                  <div class="filter-container p-0 row">
                    @foreach($rooms as $room)
                    <div style="background-color: #ccc; padding:0;" class="filtr-item col-sm-2 room" data-category="2, 4" data-sort="black sample">
                      <a href="{{ route('clientInvoice', ['room' => $room['room_number']]) }}" data-toggle="lightbox" data-title="sample 12 - black">
                        <img class="roomImg" style="max-width: 100%;" src="{{asset($room['image'])}}" class="img-fluid mb-2" alt="black sample"/>
                        
                        <p style="margin-bottom: 0; color: black;"> price: {{ (float)number_format(($room['price']/100), 2, '.', '') }}$</p>
                      <p style="margin-bottom: 0; color:black; "> Capacity: {{ $room['capacity'] }}</p>
                      <div style="text-align: center;">
                      <p class="btn btn-primary" style="margin: 10px 0 0 0 ;">Reserve!</p>

                      </a>
                      @endforeach


            <h3 class="profile-username text-center">{{$client['name']}}</h3>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Gender</b> <a class="float-right">{{$client['gender']}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Phone </b> <a class="float-right">{{$client['mobile']}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{$client['email']}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Country</b> <a class="float-right">{{$client['country']}}</a>
                  </li>
                </ul>

              </div>
            </div>

@endsection
