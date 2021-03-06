
@extends('layouts.page')
@section('title')Index Page
@endsection
@section('content')
<a href="{{route('rooms.create')}}" class="btn btn-success text-center"  ><i class="ionicons ion-android-create"></i>  Create room</a>
<div class="card">
    <div class="card-header">
     <h3 class="card-title">rooms</h3>
    </div>


        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover display" style="width:100%">
                <thead>


        <tr>
            <th>Room Number</th>
            <th>Floor Name</th>
            <th>Capacity</th>
            <th>Price in Dollars</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th>
        </tr>
    </thead>
    @php($count=0)
    @foreach($rooms as $room)

    <tr>
        <th scope="row">{{ $room->room_number }}</th>


        <td>{{ $room->floors ? $room->floors->name : 'floor name'}} </td>

        <td>{{$room->capacity}}</td>
        <td>{{$priceInDollars[$count]}}$
          @php($count++)</td>
        <td>{{ \Carbon\Carbon::parse( $room->created_at)->isoFormat('Y-M-D') }}</td>
        <td>{{ \Carbon\Carbon::parse( $room->updated_at)->isoFormat('Y-M-D') }}</td>

        <td>


            <a href="{{route('rooms.edit',['room' => $room['room_number']])}}" class="btn btn-secondary"
                style="margin-bottom: 20px;">Edit</a>
            <form style="display:inline" method="POST"
                action="{{route('rooms.destroy',['room' => $room['room_number']])}}">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Are you sure?')" class="btn btn-danger" type="submit"
                    style="margin-bottom: 20px;">Delete</button>
            </form>
        </td>
    </tr>

        @endforeach
            </tbody>
          </table>
        </div>
    </div>




  </div>


@endsection

