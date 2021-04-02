@extends('layouts.page')
@section('title')Manage clients
@endsection
@section('content')

<div class="card">
 
  <div class="card-header">
    <h3 class="card-title">Manage clients</h3>
  </div>
  <!-- /.card-header -->
 
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover display" style="width:100%">
                <thead>
                  <tr>
                    <th>Client Name</th>
                    <th>Email</th>
                    <th>mobile</th>
                    <th>country</th>
                    <th>gender</th>
                    <th>Action</th>
             
                  </tr>
                </thead>
                  <tbody>
                  @foreach ($ManagedClientsdata as $client)
                  <tr>
 
                    <td name='name' value='name'>{{ $client['name'] }}</td>
                    <td name='email' value='email'>{{  $client['email']   }}</td>
                    <td name='mobile' value='mobile'>{{  $client['mobile'] }}</td>
                    <td name='country' value='country'>{{  $client['country'] }}</td>
                    <td name='gender' value='gender'> {{  $client['gender'] }}</td>
 
                    <td>
                    <form method="GET" action="{{route('acceptClient',['client' => $client['email']])}}" style="display:inline;margin:0px;padding:0px">
                    <button class="btn btn-success" style="margin-bottom:20px;" onclick="return confirm('Are you sure you want to Accept ?')">Accept Request</button>
                  </form>
 
                  <form method="POST" action="{{route('clients.delete',['client' => $client['id']])}}" style="display:inline;margin:0px;padding:0px">
                  @csrf @method('DELETE')
                    <button class="btn btn-danger" style="margin-bottom:20px;" onclick="return confirm('Are you sure you want to delete ?')">Delete Request</button>
                  </form>
 

            @endforeach
                 </tbody>
            </table>
         </div>
 
</div>
 
@endsection

 