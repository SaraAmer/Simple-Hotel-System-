@extends('layouts.page')
@section('title')Index Page
@endsection
@section('content')


  
    <!-- Main content -->
 
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">Your Reservations</h4>
              </div>
              <div class="card-body">
                <div>
          
                  
                  <div class="filter-container p-0 row">
                    @foreach($rooms as $room)
                    <div style="background-color: #ccc; padding:0;" class="filtr-item col-sm-2 room" data-category="2, 4" data-sort="black sample">
                        <img class="roomImg" style="max-width: 100%;" src="{{asset($room['image'])}}" class="img-fluid mb-2" alt="black sample"/>
                        
                        <p style="margin-bottom: 0; color: black;">Paid price: {{ (float)number_format(($room['price']/100), 2, '.', '') }}$</p>
                      <p style="margin-bottom: 0; color:black; ">Capacity : {{ $room['capacity'] }}</p>

                        </div>
                       
                      @endforeach

                      </div>
  

              </div>
            </div>

@endsection
