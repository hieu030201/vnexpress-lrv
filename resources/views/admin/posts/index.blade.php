@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            <i class="fas fa-users"></i> Roles
                <a href="/admin/posts/create" style="float: right;" class="btn btn-success btn-sm float-right"><i class="fas fa-users"></i> Create Post</a>
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
                            <th scope="col">Title</th>
                            <th scope="col">Nội dung</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tác giả</th>
                            <th scope="col">Thể Loại</th>
                            <th scope="col">Action</th>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->id}}</td>
                                <td>{{$post->name}}</td>
                                <td>{{$post->short_des}}...</td>
                                <td>
                                <img style="height:100px;" src="{{asset('post_images')}}/{{$post->image}}" alt="{{$post->name}}"  width="120px" heigh="120px;" class="img-thumbnail">
                                </td>
                                <td>{{$post->user_name}}</td>
                                <td>{{optional($post->categories)->name}}</td>
                                <td>{{$post->user_name}}</td>
                                @can('edit_post')
                                <td>
                                    <a href="/admin/posts/edit/{{$post->id}}" class="btn btn-warning">Edit</a>
                                </td>
                                @endcan
                                @can('delete_post')
                                <td>
                                    <form action="/admin/posts/delete/{{$post->id}}" method="POST">
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
