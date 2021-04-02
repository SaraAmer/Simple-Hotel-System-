@extends('layouts.page')

@section('title')Show Page @endsection

@section('content')


<div class="card mt-4 ml-4 mr-4 ">
    <div class="card-header bg-primary">
      Receptionist Info
    </div>
    <div class="card-body">
      <label class="card-title text-info">Name:</label>
      <p class="card-text border-bottom ">{{ $receptionist->name }}</p>
      <label class="card-title text-info">Email:</label>
      <p class="card-text border-bottom">{{ $receptionist->email  }}</p>
      <label class="card-title text-info">National ID:</label>
      <p class="card-text border-bottom">{{ $receptionist->national_id }}</p>
      <label class="card-title text-info">Created At:</label>
      <p class="card-text border-bottom">{{ \Carbon\Carbon::parse( $receptionist->created_at )->isoFormat('ddd Do \of MMMM YYYY, h:mm:ss a') }}</p>
      <div class="form-group text-info">
        <label>Profile Image</label>
        <br />
        <img src="{{ asset( $receptionist['avatar_image'] )}}" width="100" heigth="100" />
        <br />

      </div>

    </div>
</div>

@endsection
