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
                        <h2>Create a new blog</h2>
                        <div class="ml-auto">
                            <a href="{{route('blogs.index')}}" class="btn btn-outline-secondary">Back to all Blogs</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{route('blogs.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="blog-title">Title</label>
                            <input type="text" name="title" id="blog-title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="blog-text">Text</label>
                            <textarea name="body" id="blog-text" cols="30" rows="5" class="form-control"></textarea>
                        </div>

                        <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::id()}}" class="form-control">

                        <div class="form-group">
                            <label for="blog-category">Category</label>
                            <select name="category_id" id="blog-category" class="form-control form-control-lg">
                                @foreach($cats as $cat)
                                    <option value="{{$cat->id}}">{{$cat->text}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="blog-tags">Tags</label>
                            <select name="tag_id" id="blog-tags" class="form-control form-control-lg">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary btn-lg">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
