

@extends('layouts.page')
@section('title')admin page
@endsection
@section('content')


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">


                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"> {{ Auth::user() ? Auth::user()->name :
                                "username"}}</h3>

                          <p class="text-muted text-center">{{ Auth::user() ? Auth::user()->role : "role undefined"}}</p>


                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Clients</b> <a class="float-right">{{App\Models\Client::get()->count()}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Receptionist</b> <a
                                        class="float-right">{{App\Models\Receptionist::get()->count()}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Managers</b> <a class="float-right">{{App\Models\Manager::get()->count()}}</a>
                                </li>
                            </ul>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
            </section>
        </div>


</body>


@endsection



