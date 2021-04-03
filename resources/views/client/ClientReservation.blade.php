@extends('layouts.master')
@extends('layouts.page')
@section('title')Manage Receptionist
@endsection
@section('content')

<div class="card-header">
  <h3 class="card-title">Receptionists</h3>
</div>

<div class="card-body">
  <table id="managers-table" class="table table-bordered table-hover display" style="width:100%">

    <thead>
      <tr>


        <th>Client's Name</th>
        <th>Accompany Number</th>
        <th>Room Number</th>
        <th>Client paid price</th>


      </tr>
    </thead>
  </table>
  <meta name="csrf-token" content="{{ csrf_token() }}">


</div>
</div>

@stop

@push('scripts')

<script>
  $('#managers-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{!! route('Receptionist.ClientReservation.data') !!}",
    columns: [{


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
      }



    ]
  });
</script>

</script>


@endpush