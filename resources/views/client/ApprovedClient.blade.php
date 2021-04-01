@extends('layouts.page')
@section('title')Approved client
@endsection
@section('content')
<div class="card-body">
  <table id="example2" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Client Name</th>
        <th>Client Email</th>
        <th>Client Mobile</th>
        <th>Country</th>
        <th>Client Gender</th>
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
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
</div>
</div>

@endsection