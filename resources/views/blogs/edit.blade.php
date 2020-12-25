@extends('layouts.app')

@section('head-content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Edit a blog with ID {{$blog->id}}</h2>
                        <div class="ml-auto">
                            <a href="{{route('blogs.index')}}" class="btn btn-outline-secondary">Back to all Blogs</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{route('blogs.update', $blog->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="blog-title">Title</label>
                            <input type="text" value="{{$blog->title}}" name="title" id="blog-title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="blog-text">Text</label>
                            <textarea name="body" id="blog-text" cols="30" rows="5" class="form-control">{{$blog->body}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="blog-category">Category</label>
                            <select name="category_id" id="blog-category" class="form-control form-control-lg">
                                @foreach($cats as $cat)
                                    @if($cat->id == $blog->category->id)
                                        <option value="{{$cat->id}}" selected>{{$cat->text}}</option>
                                    @else
                                        <option value="{{$cat->id}}">{{$cat->text}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary btn-lg">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
