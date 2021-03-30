@extends('layouts.page')
@section('title')Manage Floors
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
                  @foreach ($ManagedClients as $client)

                  <tr>
                    <!-- <td>Marwa</td>
                    <td>eng.marwamedhat2020@gmail.com</td>
                    <td>01777777777</td>
                    <td>Egypt</td>
                    <td>female</td> -->
                    <td>{{ $client['name'] }}</td>
                    <td>{{  $client['email']   }}</td>
                    <td>{{  $client['mobile'] }}</td>
                    <td>{{  $client['country'] }}</td>
                    <td> {{  $client['gender'] }}</td>

                    <td>
                    <form method="GET" action="{{route('Receptionist.ManageClient')}}" style="display:inline;margin:0px;padding:0px">
                    <button class="btn btn-success" style="margin-bottom:20px;" onclick="return confirm('Are you sure you want to Accept ?')">Accept</button>
                  </form>

                  <form method="GET" action="{{route('Receptionist.ManageClient')}}" style="display:inline;margin:0px;padding:0px">
                    <button class="btn btn-danger" style="margin-bottom:20px;" onclick="return confirm('Are you sure you want to decline ?')">Decline</button>
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

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
