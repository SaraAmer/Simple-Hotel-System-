
@extends('layouts.page')
@section('title')Index Page
@endsection
@section('content')
<a href="{{route('rooms.create')}}" class="btn btn-success text-center"  ><i class="ionicons ion-android-create"></i>  Create room</a>
<div class="card">
    <div class="card-header">
     <h3 class="card-title">rooms</h3>
    </div>
    <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <thead>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Actions</th>
        </tr>
    </thead>
    @foreach($rooms as $room)

    <tr>
        <th scope="row">{{ $room->id }}</th>
        <td>{{ $room->name }}</td>
        <td>{{ $room->email }}</td>
        <td>{{ \Carbon\Carbon::parse( $room->created_at,'d/m/Y H:i:s')->isoFormat('Y-M-D') }}</td>
        <td>{{ \Carbon\Carbon::parse( $room->updated_at,'d/m/Y H:i:s')->isoFormat('Y-M-D') }}</td>

        <td>

            <a href="{{route('rooms.edit',['room' => $room['id']])}}" class="btn btn-secondary"
                style="margin-bottom: 20px;">Edit</a>
            <form style="display:inline" method="POST"
                action="{{route('rooms.destroy',['room' => $room['id']])}}">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Are you sure?')" class="btn btn-danger" type="submit"
                    style="margin-bottom: 20px;">Delete</button>
            </form>
        </td>
    <tr>
        @endforeach
            </tbody>
          </table>
        </div>
    </div>




  </div>


@endsection

