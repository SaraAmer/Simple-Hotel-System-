@extends('layouts.page')
@section('title')Manage Manager
@endsection
@section('content')
<a href="{{route('managers.create')}}" class="btn btn-success text-center"><i class="ionicons ion-android-create"></i>
    Create Manager</a>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Managers</h3>
    </div>

        <div class="card-body">
    <table id="example2" class="table table-bordered table-hover display" style="width:100%">


                <thead>

        <tr>
            <th>Manager's ID</th>
            <th>Managers's Name</th>
            <th>Manager's Email</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Actions</th>
        </tr>
    </thead>
    @foreach($Managers as $manager)

    <tr>
        <th scope="row">{{ $manager->id }}</th>
        <td>{{ $manager->name }}</td>
        <td>{{ $manager->email }}</td>

        <td> {{$manager->created_at}}</td>
        <td> {{$manager->updated_at}}</td>

        <td>
            <a href="{{route('managers.show',['manager' => $manager['id']])}}" class="btn btn-primary"
                style="margin-bottom: 20px;">Show</a>
            <a href="{{route('managers.edit',['manager' => $manager['id']])}}" class="btn btn-secondary"
                style="margin-bottom: 20px;">Edit</a>

            <form style="display:inline" method="POST"
                action="{{route('managers.destroy',['manager' => $manager['id']])}}">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Are you sure?')" class="btn btn-danger" type="submit"
                    style="margin-bottom: 20px;">Delete</button>
            </form>
        </td>
    </tr>
        @endforeach
            </tbody>
          </table>
        </div>
    </div>

@endsection


