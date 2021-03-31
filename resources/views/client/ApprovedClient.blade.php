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
                    <td>{{  $client['email']   }}</td>
                    <td>{{  $client['mobile'] }}</td>
                    <td>{{  $client['country'] }}</td>
                    <td> {{  $client['gender'] }}</td>
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
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


</body>
@endsection
