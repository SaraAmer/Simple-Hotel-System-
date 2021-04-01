@extends('layouts.page')
@section('title')Index Page
@endsection
@section('content')


      <!-- Main content -->
    

              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{asset($manager['avatar_image'])}}"
                      alt="User profile picture">
                  </div>

                  <h3 class="profile-username text-center">{{$manager['name']}}</h3>



                  <ul class="list-group list-group-unbordered mb-3">
                
                    <li class="list-group-item">
                      <b>Email</b> <a class="float-right">{{$manager['email']}}</a>
                    </li>
                   
                    <li class="list-group-item">
                      <b>Receptionist</b> <a class="float-right">{{$receptionists->count()}}</a>
                    </li>
                    <li class="list-group-item">
                      <b>Floors</b> <a class="float-right">{{$floors->count()}}</a>
                    </li>
                  </ul>

                </div>
@endsection