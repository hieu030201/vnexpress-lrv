@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
           
            <div class="col-md-8">
            <i class="fas fa-users"></i> Roles
                <a href="/admin/roles/create" style="float: right;" class="btn btn-success btn-sm float-right"><i class="fas fa-users"></i> Create Role</a>
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Dispay Name</th>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->display_name}}</td>
                                @can('edit_role')
                                <td>
                                    <a href="/admin/roles/edit/{{$role->id}}" class="btn btn-warning">Edit</a>
                                </td>
                                @endcan
                                @can('delete_role')
                                <td>
                                    <form action="/admin/roles/delete/{{$role->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Xóa" class="btn btn-danger">
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
