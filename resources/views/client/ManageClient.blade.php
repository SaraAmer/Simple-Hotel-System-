@extends('layouts.master')
@extends('layouts.page')
@section('title')Manage Manager
@endsection
@section('content')
@hasanyrole('admin|manager')
<a href="{{route('client.create')}}" class="btn btn-success text-center"><i
    class="ionicons ion-android-create"></i> Create client</a>
@endhasanyrole
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Clients</h3>
  </div>

  <div class="card-body">
    <table id="managers-table" class="table table-bordered table-hover display" style="width:100%">


      <thead>

        <tr>
          <th>Client Id</th>
          <th>Client's Name</th>
          <th>Client's Email</th>
          <th>Created at</th>
          <th>Updated at</th>
          <th>Actions</th>
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
    ajax: "{!! route('Receptionist.ManageClient.data') !!}",
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
          url: '/clients/delete/' + id,
          data: {
            "client": id,
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