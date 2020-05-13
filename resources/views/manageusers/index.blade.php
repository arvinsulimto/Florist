@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Manage Users</div>

                @if($users->count()==0)
                    <div class="card-body">
                        <div class="alert alert-info" role="alert">No users available</div>
                    </div>
                @else
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Profile Picture</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="images-profile col-lg-1">
                                                <img src="/storage/{{ $user->profile }}" alt="{{ $user->name }}" class="rounded-circle" width="100px" height="100px">
                                            </div>
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>
                                            <div class="btn-toolbar">
                                                <a href="/manageusers/{{$user->id}}/edit" class="btn btn-primary margin-horizontal">Edit</a>
                                                <form method="post" action="{{route('manageusers/destroy',$user->id)}}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger margin-horizontal">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $users->links() }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
