@extends('layouts.page')
@section('title')Index Page
@endsection
@section('content')

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="{{asset($client['avatar_image'])}}"
                alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{$client['name']}}</h3>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Gender</b> <a class="float-right">{{$client['gender']}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Phone </b> <a class="float-right">{{$client['mobile']}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{$client['email']}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Country</b> <a class="float-right">{{$client['country']}}</a>
                  </li>
                </ul>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    @endsection