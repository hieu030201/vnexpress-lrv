@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
           
            <div class="col-md-12">
            <i class="fas fa-users"></i> User
                <a href="/admin/users/create" style="float: right;" class="btn btn-success btn-sm float-right"><i class="fas fa-users"></i> Create User</a>
                <hr>
                @if(Session()->has('status'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" aria-label="close" data-dismiss="alert">X</button>
                        {{Session()->get('status')}}
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Avatar</th>
                            <th scope="col">Fullname</th>
                            <th scope="col">Email</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>
                                <img style="height:100px;" src="{{asset('avatar_images')}}/{{$user->avatar}}" alt="{{$user->name}}"  width="120px" heigh="120px;" class="img-thumbnail">
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                @can('edit_user')
                                <td>
                                    <a href="/admin/users/edit/{{$user->id}}" class="btn btn-warning">Edit</a>
                                </td>
                                @endcan
                                @can('delete_user')
                                <td>
                                    <form action="/admin/users/delete/{{$user->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="DELETE" class="btn btn-danger">
                                    </form>
                                </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
