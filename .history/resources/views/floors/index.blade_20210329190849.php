
@extends('layouts.page')
@section('title')Manage Floors
@endsection
@section('content')
<a href="{{route('floors.create')}}" class="btn btn-success text-center"  ><i class="ionicons ion-android-create"></i>  Create Floors</a>
<div class="card">
    <div class="card-header">
     <h3 class="card-title">Floors</h3>
    </div>
    <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
            <thead>
              <thead>

        <tr>
            <th>Name</th>
            <th>Number</th>
            <th>Manager Name</th>  {{-- low el role bt3na admin bss tban 8air kda mfrod mtbnsh  --}}
            <th>Actions</th>
        </tr>
    </thead>
    @foreach($floors as $floor)

    <tr>
        <th scope="row">{{ $floor->name }}</th>
        <td>{{ $floor->number }}</td>
        <td>
        {{
            $floor->manager ?  $floor->manager->name : 'floor not found'</td>
          }}
        <td>

            {{-- <a href="{{route('floors.edit',['floors' => $floor['number']])}}" class="btn btn-secondary"
                style="margin-bottom: 20px;">Edit</a>
            <form style="display:inline" method="POST"
                action="{{route('floors.destroy',['floors' => $floor['number']])}}">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Are you sure?')" class="btn btn-danger" type="submit"
                    style="margin-bottom: 20px;">Delete</button>
            </form> --}}
        </td>
    <tr>
        @endforeach
            </tbody>
          </table>
        </div>
    </div>




  </div>


@endsection

