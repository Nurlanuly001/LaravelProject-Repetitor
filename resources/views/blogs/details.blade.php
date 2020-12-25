@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="col-md-12 text-center">
                    <h5>{{$blog->title}}</h5>
                </div>
                <div class="col-md-6 offset-3 mt-5">
                    {{$blog->body}}
                </div>
                <div class="col-md-6 offset-3 mt-5">
                    <b>Tags:</b>
                    <ul>
                        @foreach($blog->tags as $tag)
                            <li>{{$tag->name}}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6 offset-6 mt-5">
                    <b>Author:</b> {{$blog->user->name}}
                </div>
                <p class="text-center mt-5">
                    <a href="{{route('blogs.index')}}" class="btn btn-primary">GO BACK</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
