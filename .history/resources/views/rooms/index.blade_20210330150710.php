@extends('layouts.admin.master')
@section('content')


<a href="/rooms/create"><button class="btn btn-success">Create Room</button></a>
<br><br>
<table class="table table-bordered" id="rooms-table">
        <thead>
            <tr>
                <th> Room's Number</th>
                <th>Room's capacity</th>
                <th>Room's Price</th>
                @role('admin')
                <th>Created By</th>
                @endrole
                @role('admin|manager')
                <th>Action</th>
                @endrole

                
            </tr>
        </thead>
    </table>

    @stop

    @push('js')
    <script>
    $(function() {
        HTMLElement.prototype.delRoom = function(delUrl){
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
                                alert("Room is reserved it can't be deleted!");
                            }
                            else{
                                alert("Room deleted successfully");
                                window.location.href = "/rooms";
                            }                       
                    }                
                });
            }
        }
        $('#rooms-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('rooms.data') !!}',
            columns: [
                { data: 'number', name: 'number' },
                { data: 'capacity', name: 'capacity' },
                { data: 'price', name: 'price' },
                @role('admin')
                { data: 'Manager_name', name: 'Manager_name' }, 
                @endrole
                { data: 'action', name: 'action' }, 
             

            ]
            
        });
    });


    </script>
    @endpush
