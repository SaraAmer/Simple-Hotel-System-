@extends('layouts.page')
@section('title')Profile of Receptionists
@endsection
@section('content')
<!-- Profile Image -->
<div class="card card-primary card-outline">
  <div class="card-body box-profile">
    <div class="text-center">
      <img class="profile-user-img img-fluid img-circle" src="{{asset($Receptionist['avatar_image'])}}"
        alt="User profile picture">
    </div>

    <h3 class="profile-username text-center">{{ $Receptionist['name'] }}</h3>

    <p class="text-muted text-center">Receptionist</p>

   
                  <li class="list-group-item">
                    <b>National ID </b> <a class="float-right">{{  $Receptionist['national_id'] }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{   $Receptionist['email']   }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>status </b> <a class="float-right">{{   $Receptionist['status']   }}</a>
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