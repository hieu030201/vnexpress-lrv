@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <i class="fas fa-chair"></i> Create a User
                <hr>
                <form action="/admin/users/update/{{$user->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name">User Name</label>
                        <input type="text" name="name" value="{{$user->name}}" class="form-control" placeholder="Name...">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{$user->email}}" class="form-control" placeholder="Email...">
                    </div>
                    <div class="form-group">
                        <label for="password">User Password</label>
                        <input type="password" name="password" value="{{$user->password}}" class="form-control" placeholder="Password...">
                    </div>
                    <form>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Avatar</label>
                        <input type="file" name="avatar" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <div class="col-auto my-1">
                    <label class="mr-sm-2" for="inlineFormCustomSelect">Role</label>
                    <select  class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="roles[]" multiple="multiple">
                        @foreach($roles as $role)
                            <option {{ $listRoleOfUser->contains($role->id) ? 'selected' : ''}} value="{{$role->id}}">{{$role->display_name}} </option>
                        @endforeach
                    </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>

@endsection