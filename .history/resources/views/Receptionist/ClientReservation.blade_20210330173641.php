@extends('layouts.page')
@section('title')Manage Floors
@endsection
@section('content')
              <!-- <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div> -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Client Name</th>
                    <th>Accompany Number</th>
                    <th>Room Number</th>
                    <th>Client paid price</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ( $ClientReservation as $client)
                  @foreach ($ClientReservationName as $clientn)
                  <tr>
                    <!-- <td>Marwa</td>
                    <td>3</td>
                    <td>1</td>
                    <td>100</td> -->
<!--
                    <td>{{ $client['client_id'] }}</td> -->
                    <td>{{ $clientn['name'] }}</td>
                    <td>{{  $client['accompany_number']   }}</td>
                    <td>{{  $client['room_number'] }}</td>
                    <td>{{  $client['paid price'] }}</td>
                  </tr>
                  @endforeach
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
