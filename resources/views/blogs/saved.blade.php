@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="col-md-12 text-center">
                    <h2>Created blog with category: {{$cat}}</h2>
                    <h3>And title: {{$title}}</h3>
                    <h3>And text: {{$text}}</h3>
                </div>
                <div class="col-md-12">
                    <div class="text-center my-3">
                        <a href="{{route('blogs.index')}}" class="btn btn-outline-secondary">Back to all blogs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
