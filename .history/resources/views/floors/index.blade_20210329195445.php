
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
            @role('admin')
            <th>Manager Name</th>
            @endrole
            <th>Actions</th>
        </tr>
    </thead>
    {{-- @foreach($floors as $floor)

    <tr>
        <th scope="row">{{ $floor->name }}</th>
        <td>{{ $floor->number }}</td>
          <td>{{$floor->manager ?  $floor->manager->name : 'floor not found' }}</td>
        <td>

            <a href="{{route('floors.edit',['floor' => $floor['number']])}}" class="btn btn-secondary" style="margin-bottom: 20px;">Edit</a>
            <form style="display:inline" method="POST"
                action="{{route('floors.destroy',['floor' => $floor['number']])}}">
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
 --}}


 <script>
 HTMLElement.prototype.delFloor = function(delUrl){
     var resp = confirm("Are you sure you want to delete this room?");
     if (resp == true) {
         $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
         });
         $.ajax(
         {
             url: delUrl,
             type: 'delete',
             dataType: "JSON",
             data: "{}",
             success: function (response)
             {
                 if(!response){
                     alert("Floor rooms are not empty it can't be deleted!");
                 }
                 else{
                     alert("Floor deleted successfully");
                     window.location.href = "/floors";
                 }

             }
         });
     }
 }
 $(function() {
     $('#floors-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('floors.index') !!}',
         columns: [
             { data: 'name', name: 'name' },
             { data: 'number', name: 'number' },

             @role('admin')
             {data: 'Manger_name', name: 'Manger_name'},
             @endrole
             {data: 'action', name: 'action'},

     ]

     });
 });
 </script>
 @endsection

