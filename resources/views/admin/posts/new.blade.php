@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <i class="fas fa-chair"></i> Create a Post
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
                <form action="/admin/posts/store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name...">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Thể Loại</label>
                        <select name="category_id" class="form-control" id="exampleFormControlSelect1">
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Avatar</label>
                        <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                    </div>

                    <div class="form-group">
                        <label for="name">Short Description</label>
                        <input type="text" name="short_des" class="form-control" placeholder="description...">
                    </div>
                    
                    <div>
                        <label for="exampleFormControlFile1">Content</label>
                        <textarea name="description" id="summernote" cols="30" rows="10"></textarea>
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>

@endsection