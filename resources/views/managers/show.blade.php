@extends('layouts.page')

@section('title')Show Page @endsection

@section('content')


<div class="card mt-4 ml-4 mr-4 ">
    <div class="card-header bg-primary">
      Manager Info
    </div>
    <div class="card-body">
      <label class="card-title text-info">Name:</label>
      <p class="card-text border-bottom ">{{ $manager->name }}</p>
      <label class="card-title text-info">Email:</label>
      <p class="card-text border-bottom">{{ $manager->email  }}</p>
      <label class="card-title text-info">National ID:</label>
      <p class="card-text border-bottom">{{ $manager->national_id }}</p>
      <label class="card-title text-info">Created At:</label>
      <p class="card-text border-bottom">{{ \Carbon\Carbon::parse( $manager->created_at )->isoFormat('ddd Do \of MMMM YYYY, h:mm:ss a') }}</p>
      <div class="form-group text-info">
        <label>Profile Image</label>
        <br />
        <img src="{{asset( $manager['avatar_image'] )}}" width="100" heigth="100" />
        <br />

      </div>

    </div>
</div>

@endsection
