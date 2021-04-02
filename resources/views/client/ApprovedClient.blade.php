@extends('layouts.page')
@section('title')Approved client
@endsection
@section('content')

<div class="card-body">
@hasanyrole('admin|manager')
<a href="{{route('client.create')}}" class="btn btn-success text-center"><i
    class="ionicons ion-android-create"></i> Create client</a>
@endhasanyrole
  <table id="example2" class="table table-bordered table-hover">
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
    <tbody>
      @foreach ($ApprovedClient as $client)
      <tr>
        <!-- <td>Marwa</td>
                    <td>eng.marwamedhat2020@gmail.com</td>
                    <td>012588888888</td>
                    <td>Egypt</td>
                    <td> famle</td> -->
        <td>{{ $client['name'] }}</td>
        <td>{{ $client['email'] }}</td>
        <td>{{ $client['mobile'] }}</td>
        <td>{{ $client['country'] }}</td>
        <td> {{ $client['gender'] }}</td>
        <td>                  @hasanyrole('admin|manager')
                 <a href="{{route('client.edit',['client' => $client['id']])}}" class="btn btn-secondary"
                    style="margin-bottom: 20px;">Edit</a>
                    <form method="POST" action="{{route('client.destroy',['client' => $client['id']])}}" style="display:inline;margin:0px;padding:0px">
                  @csrf @method('DELETE')
                    <button class="btn btn-danger" style="margin-bottom:20px;" onclick="return confirm('Are you sure you want to delete ?')">Delete</button>
                  </form>
                </td>
            </tr>
            @endhasanyrole
            </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
</div>
</div>

@endsection