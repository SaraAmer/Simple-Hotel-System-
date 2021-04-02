@extends('layouts.page')
@section('title')Manage Receptionists
@endsection
@section('content')
<a href="{{route('receptionists.create')}}" class="btn btn-success text-center"><i
    class="ionicons ion-android-create"></i> Create Receptionist</a>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Receptionists</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">

    <table id="example2" class="table table-bordered table-hover display" style="width:100%">


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
      <tbody>
        @foreach($Receptionist as $receptionist)
        <tr>
          <th scope="row">{{ $receptionist->id }}</th>
          <td>{{ $receptionist->name }}</td>
          <td>{{ $receptionist->email }}</td>
          <td>{{ \Carbon\Carbon::parse( $receptionist->created_at)->isoFormat('Y-M-D') }}</td>
          <td>{{ \Carbon\Carbon::parse( $receptionist->updated_at)->isoFormat('Y-M-D') }}</td>
          @role('admin')
          <td>{{

            $receptionist->manager ? $receptionist->manager->name : 'By admin'
            }}

          </td>
          @endrole
          <td>
            <a href="{{route('receptionists.show',['receptionist' => $receptionist['id']])}}" class="btn btn-primary"
                style="margin-bottom: 20px;">Show</a>
            <a href="{{route('receptionists.edit',['receptionist' => $receptionist['id']])}}" class="btn btn-secondary"
              style="margin-bottom: 20px;">Edit</a>
            @if($receptionist->isBanned())
            <a href="{{route('receptionists.unban',['receptionist' => $receptionist['id']])}}" class="btn btn-success"
              style="margin-bottom: 20px;">UnBan</a>
            @else
            <a href="{{route('receptionists.ban',['receptionist' => $receptionist['id']])}}" class="btn btn-danger"
              style="margin-bottom: 20px;">Ban</a>
            @endif
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <button class="delete-btn btn btn-danger" style="margin-bottom: 20px;" value="{{$receptionist->id}}"
              data-id="{{$receptionist->id}}">Delete</button>
          </td>
        </tr>


        @endforeach
      </tbody>
    </table>

  </div>

</div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
  $(document).ready(function() {

    $(".delete-btn").on("click", function() {
      let id = $(this).data("id");
      let token = $("meta[name='csrf-token']").attr("content");
      let answer = confirm("are you sure you want to delete this receptionist?");
      if (answer) {
        $.ajax({
            type: "DELETE",
            url: "/receptionists/" + id,
            data: {
              "receptionist": id,
              "_token": token,
            },
            success: function() {

              location.reload();

            }
          }


        );
      }

    });
  });
</script>
