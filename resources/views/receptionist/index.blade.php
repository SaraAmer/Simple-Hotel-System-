@extends('layouts.master')
@extends('layouts.page')
@section('title')Manage Receptionist
@endsection
@section('content')
<a href="{{route('receptionists.create')}}" class="btn btn-success text-center"><i
        class="ionicons ion-android-create"></i>
    Create Receptionist</a>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Receptionists</h3>
    </div>

    <div class="card-body">
        <table id="managers-table" class="table table-bordered table-hover display" style="width:100%">

            <thead>
                <tr>
                    <th style="width: 10px">ID</th>

                    <th>Receptionist's Name</th>
                    <th>Receptionist's Email</th>
                    <th>Created_at</th>
                    <th>Updated at</th>
                    @role('admin')
                    <th>Manager Name</th>
                    @endrole
                    <th>Actions</th>

                </tr>
            </thead>
        </table>
        <meta name="csrf-token" content="{{ csrf_token() }}">


    </div>
</div>

@stop

@push('scripts')
@role('admin')
<script>
    $('#managers-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! route('receptionist.data') !!}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'updated_at',
                name: 'updated_at'
            },

            {
                data: 'managers',

            },
            {
                data: 'action',

            }
        ]
    });
</script>
@endrole
@role('manager')
<script>
    $('#managers-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! route('receptionist.data') !!}",
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'updated_at',
                name: 'updated_at'
            },


            {
                data: 'action',

            }
        ]
    });
</script>
@endrole
<script>
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
                    url: '/receptionists/' + id,
                    data: {
                        "receptionist": id,
                    },
                    success: function(data) {

                        $('#managers-table').DataTable().ajax.reload();


                    }
                }


            );
        }

    });
</script>


@endpush