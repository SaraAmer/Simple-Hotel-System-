@extends('layouts.page')
@section('title')Manage clients
@endsection
@section('content')



              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
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
                  @foreach ($ManagedClientsdata as $clientdata)
                  <tr>
                    <!-- <td>Marwa</td>
                    <td>eng.marwamedhat2020@gmail.com</td>
                    <td>01777777777</td>
                    <td>Egypt</td>
                    <td>female</td> -->


                    <td name='name' value='name'>{{ $client['name'] }}</td>
                    <td name='email' value='email'>{{  $client['email']   }}</td>
                    <td name='mobile' value='mobile'>{{  $client['mobile'] }}</td>
                    <td name='country' value='country'>{{  $client['country'] }}</td>
                    <td name='gender' value='gender'> {{  $client['gender'] }}</td>


                    <td>
                    <form method="GET" action="{{route('acceptClient',['client' => $clientdata['email']])}}" style="display:inline;margin:0px;padding:0px">
                    <button class="btn btn-success" style="margin-bottom:20px;" onclick="return confirm('Are you sure you want to Accept ?')">Accept</button>
                  </form>

                  <form method="POST" action="{{route('clients.destory',['client' => $clientdata['id']])}}" style="display:inline;margin:0px;padding:0px">
                  @csrf @method('DELETE')
                    <button class="btn btn-danger" style="margin-bottom:20px;" onclick="return confirm('Are you sure you want to delete ?')">Delete</button>
                  </form>
                    <td>


                    <!-- <form>
                    <button type="submit" class="btn btn-success">Accept</button>
                    <button type="submit" class="btn btn-success">decline</button>

                    </form> -->


                  </tr>
                  @endforeach

                  </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>
    </section>
  </div>


</body>
@endsection

