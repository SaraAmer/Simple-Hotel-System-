@extends('layouts.page')
@section('title')Index Page
@endsection
@section('content')
            
             
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">Browse Our Rooms</h4>
              </div>
              <div class="card-body">
                <div>
          
                  
                  <div class="filter-container p-0 row">
                    @foreach($rooms as $room)
                   
                    <div style="background-color: #ccc; padding:0;" class="filtr-item col-sm-2 room" data-category="2, 4" data-sort="black sample">
               
                        <img class="roomImg" style="max-width: 100%;" src="" class="img-fluid mb-2" alt="black sample"/>
                        
                        <p style="margin-bottom: 0; color: black;"> price: {{ $room['price_inCents'] }}$</p>
                      <p style="margin-bottom: 0; color:black; "> Capacity: {{ $room['capacity'] }}</p>
                      @role('client')
                      <div style="text-align: center;">
                      <a href="{{ route('client.invoice', ['roomNumber' => $room['room_number']]) }}" class="btn btn-primary" style="margin: 10px 0 0 0 ;">
                      Reserve!</a>
                       @endrole
                    
                      

                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>

              </div>
            </div>
          </div>
        
          
        </div>
    


 @endsection