@extends('layouts.page')
@section('title')Profile of Receptionists
@endsection
@section('content')
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../../dist/img/user4-128x128.jpg"
                       alt="User profile picture">
                </div>
                <!-- Receptionist table data
                'name', 'email','national_id','avatar_image','updated_at','manger_id' -->

                <!-- <td>{{  $Receptionist['name'] }}</td>
                    <td>{{   $Receptionist['email']   }}</td>
                    <td>{{   $Receptionist['mobile'] }}</td>
                    <td>{{   $Receptionist['country'] }}</td>
                    <td> {{   $Receptionist['gender'] }}</td>
                    <td> {{   $Receptionist['national_id'] }}</td> -->

                <h3 class="profile-username text-center">{{  $Receptionist['name'] }}</h3>

                <p class="text-muted text-center">Receptionist</p>

                <!-- <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Gender</b> <a class="float-right">Famele</a>
                  </li> -->
                  <!-- <li class="list-group-item">
                    <b>National ID</b> <a class="float-right">{{  $Receptionist['national_id'] }}</a>
                  </li> -->
                  <li class="list-group-item">
                    <b>email</b> <a class="float-right">{{   $Receptionist['email']   }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>country</b> <a class="float-right">Egypt</a>
                  </li>
                </ul>

                <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


            </div>
            <!-- /.card -->
          </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</body>
@endsection
