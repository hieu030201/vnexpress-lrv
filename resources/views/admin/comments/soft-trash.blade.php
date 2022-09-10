@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <i class="fas fa-align-justify"></i> Comment
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
                            <th scope="col">Content</th>
                            <th scope="col">User Comment</th>
                            <th scope="col">Bài Viết hiển thị</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <th scope="row">{{$comment->id}}</th>
                                <td scope="row">{{$comment->content}}</td>
                                <td scope="row">{{$comment->user_name}}</td>
                                <td scope="row">{{$comment->post_id}}</td>
                                <td>
                                    <form action="/admin/comments/restore/{{$comment->id}}" method="POST">
                                     @csrf
                                     <input type="submit" value="Restore" class="btn btn-danger">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
        
                </table>
                {{$comments->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>

@endsection