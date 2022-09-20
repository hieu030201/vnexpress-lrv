@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-12">
        <i class="fas fa-users"></i> Change Password
            <hr>
            @if(Session()->has('status'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" aria-label="close" data-dismiss="alert">X</button>
                    {{Session()->get('status')}}
                </div>
            @endif
        </div>
        <form action="/admin/users/update-password" method="POST">
            @csrf
            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">Old Pass</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" name="old_password" id="colFormLabel" placeholder="Enter old password">
                </div>
            </div>

            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">New Pass</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" name="new_password" id="colFormLabel" placeholder="Enter new password">
                </div>
            </div>

            <div class="form-group row">
                <label for="colFormLabel" class="col-sm-2 col-form-label">confirm Pass</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" name="confirm_password" id="colFormLabel" placeholder="Enter confirm password">
                </div>
            </div>
           

            <button type="submit" class="btn btn-primary">Update Password</button>
        </form>
    </div>
@endsection