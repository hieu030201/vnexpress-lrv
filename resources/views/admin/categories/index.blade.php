@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <i class="fas fa-align-justify"></i> Category
                <a href="/admin/categories/create" style="float: right;" class="btn btn-success btn-sm float-right"><i class="fas fa-plus"></i> Create Category</a>
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
                            <th scope="col">Category</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <th scope="row">{{$category->id}}</th>
                                <td scope="row">{{$category->name}}</td>
                                <td>
                                    <a  href="/admin/categories/{{$category->id}}/edit" class="btn btn-warning">Edit</a>
                                </td>
                                <td>
                                    <form action="/admin/categories/{{$category->id}}" method="POST">
                                     @csrf
                                     @method('DELETE')
                                     <input type="submit" value="Delete" class="btn btn-danger">

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
        
                </table>
                {{$categories->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>

@endsection