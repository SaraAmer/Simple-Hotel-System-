@extends('layouts.page')
@section('title')Profile of Receptionists
@endsection
@section('content')
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{asset($Receptionist['avatar_image'])}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{  $Receptionist['name'] }}</h3>

                <p class="text-muted text-center">Receptionist</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Gender</b> <a class="float-right">Famele</a>
                  </li>
                  <li class="list-group-item">
                    <b>Phone number</b> <a class="float-right">177777777</a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{   $Receptionist['email']   }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Country</b> <a class="float-right">Egypt</a>
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
