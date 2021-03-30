@extends('layouts.page')
@section('title')Manage Floors
@endsection
@section('content')


    <!----------------------------------------------------------------------------------------->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div> -->
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

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
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
