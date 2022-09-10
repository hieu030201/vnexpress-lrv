@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quyền Tác giả</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row text-center">
                        <div class="col-sm-4">
                            <a href="/admin/categories">  
                                <h4>Categories</h4>
                                <img width="50px" src="{{asset('images/category.png')}}"/>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="/admin/posts">
                                <h4>Posts</h4>
                                <img width="50px" src="{{asset('images/blog.png')}}"/>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="/admin/comments">
                                <h4>Comment</h4>
                                <img width="50px" src="{{asset('images/comments.png')}}"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Quyền Quản trị</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row text-center">
                        <div class="col-sm-4">
                            <a href="/admin/users">  
                                <h4>Users</h4>
                                <img width="50px" src="{{asset('images/profile.png')}}"/>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="/admin/roles">  
                                <h4>Roles</h4>
                                <img width="50px" src="{{asset('images/role.png')}}"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
