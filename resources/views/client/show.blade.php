@extends('layouts.page')

@section('title')Show Page @endsection

@section('content')


<div class="card mt-4 ml-4 mr-4 ">
    <div class="card-header bg-primary">
      Client Info
    </div>

    <div class="card-body">

      <label class="card-title text-info">Name:</label>
      <p class="card-text border-bottom ">{{ $client->name }}</p>
      <label class="card-title text-info">Email:</label>
      <p class="card-text border-bottom">{{ $client->email  }}</p>

      <label class="card-title text-info">Mobile:</label>
      <p class="card-text border-bottom">{{ $client->mobile }}</p>
      <label class="card-title text-info">Gender:</label>
      <p class="card-text border-bottom">{{ $client->gender }}</p>
      <label class="card-title text-info">Country:</label>
      <p class="card-text border-bottom">{{ $client->country }}</p>
      <label class="card-title text-info">Approval Name:</label>
      <p class="card-text border-bottom">{{ $user->name }}</p>
      <label class="card-title text-info">Created At:</label>
      <p class="card-text border-bottom">{{ \Carbon\Carbon::parse( $client->created_at )->isoFormat('ddd Do \of MMMM YYYY, h:mm:ss a') }}</p>
      <div class="form-group text-info">
        <label>Profile Image</label>
        <br />
        <img src="{{ asset( $client['avatar_image'] )}}" width="100" heigth="100" />
        <br />

      </div>


</div>

@endsection
