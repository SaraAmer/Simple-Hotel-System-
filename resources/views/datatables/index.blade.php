@extends('layouts.master')
@extends('layouts.page')

@section('content')
<table class="table table-bordered" id="users-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
    </thead>
</table>
@stop

@push('scripts')
<script>
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{!! route('datatables.data') !!}",
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
@endpush