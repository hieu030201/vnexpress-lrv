@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <i class="fas fa-chair"></i> Create a Role
                <hr>
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>

                @endif
                <form action="/admin/roles/store" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name...">
                    </div>
                    <div class="form-group">
                        <label for="name">Display Name</label>
                        <input type="text" name="display_name" class="form-control" placeholder="Display Name...">
                    </div>
                    @foreach($permissions as $permission)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="permission[]" value="{{$permission->id}}">
                        <label class="form-check-lable">{{$permission->display_name}}</label>
                    </div>
                    @endforeach
                    <br>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>

@endsection