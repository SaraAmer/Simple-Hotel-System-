
@extends('layouts.app')

@section('content')


<br/>
<br/>
<a href="/receptionists/create"><button id="new" class="btn btn-success text-center"  ><i class="ionicons ion-android-create"></i>  Create Receptionist</button></a>
 <br/>
 <br/>
<table id="users" class="table table-hover table-condensed" style="width:100%">

    <thead>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created_at</th>
            <th>Actions</th>
        </tr>
    </thead>

<tr>
    <td>---</td>
    <td>---</td>
    <td>---</td>
    <td>---</td>

  <td>
    <a href="{{ route('receptionists.edit') }}" class="btn btn-secondary" style="margin-bottom: 20px;">Edit</a>
    @csrf
        @method('DELETE')
        <button onclick="return confirm('Are you sure?')"  class="btn btn-danger" type="submit"style="margin-bottom: 20px;">Delete</button>
    </td>
    <tr>
    </table>
</div>

@endsection