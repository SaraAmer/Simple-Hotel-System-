@extends('layouts.master')
@extends('layouts.page')
@section('title')Manage Manager
@endsection
@section('content')
<a href="{{route('client.create')}}" class="btn btn-success text-center"><i
    class="ionicons ion-android-create"></i> Create client</a>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Managers</h3>
    </div>

    <div class="card-body">
        <table id="clients-table" class="table table-bordered table-hover display" style="width:100%">


            <thead>

                <tr>
        <th>Client Name</th>
        <th>Client Email</th>
        <th>Client Mobile</th>
        <th>Country</th>
        <th>Client Gender</th>
        @hasanyrole('admin|manager')
        <th>Action</th>
        @endhasanyrole
                </tr>
            </thead>

        </table>
        <meta name="csrf-token" content="{{ csrf_token() }}">


    </div>
</div>

@stop

@push('scripts')
@hasanyrole('admin|manager')
<script>
    $('#clients-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! route('Receptionist.ApprovedClient.data') !!}",
        columns: [
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'mobile',
                name: 'mobile'
            },
            {
                data: 'country',
                name: 'country'
            },
            {
                data: 'gender',
                name: 'gender'
            },

            {
                data: 'action',

            }
        ]
    });
    $(document).on('click', '.delete', function(e) {
        let id = $(this).data("id");
        let answer = confirm("are you sure you want to delete this Manager?");

        if (answer) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    type: "DELETE",
                    url: '/client/' + id,
                    data: {
                        "manager": id,
                    },
                    success: function(data) {
                       
                        $('#managers-table').DataTable().ajax.reload();
                        

                    }
                }


            );
        }

    });
</script>

@endhasanyrole
@hasrole('receptionist')
<script>
    $('#clients-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! route('Receptionist.ApprovedClient.data') !!}",
        columns: [
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'mobile',
                name: 'mobile'
            },
            {
                data: 'country',
                name: 'country'
            },
            {
                data: 'gender',
                name: 'gender'
            },

           
        ]
    });
  
</script>

@endrole
@endpush