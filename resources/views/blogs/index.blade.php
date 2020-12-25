@extends('layouts.app')

@section('head-content')
<style>
    .form-delete {
        display: inline-block;
    }
</style>
@endsection

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{route('blogs.index')}}">BLOGGING</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            @foreach($cats as $cat)
                <a class="nav-item nav-link" href="{{route('blogs.cat', $cat->id)}}">{{$cat->text}}</a>
            @endforeach
{{--            <a class="nav-item nav-link active" href="#">Home</a>--}}
{{--            <a class="nav-item nav-link" href="#">Features</a>--}}
        </div>
    </div>
</nav>

<div class="content">
    <div class="container">
        <div class="row">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="col-md-12 text-center">
                    <h5>Laravel CRUD tutorial</h5>
                </div>
                <div class="col-md-12">
                    <div class="text-center my-3">
                        <a href="{{route('blogs.create')}}" class="btn btn-outline-secondary">Create new Blog</a>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Body</th>
                            <th scope="col">Functions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($blogs as $b)
                            <tr>
                                <td style="width: 5%">{{$b->id}}</td>                                      {{--https://www.bbc.com/news/uk-54767118--}}
                                <td style="width: 25%">{{$b->title}}</td>
                                <td style="width: 45%">{{$b->body}}</td>
                                <td style="width: 25%"><a href="{{route('blogs.show', $b->id)}}" class="btn btn-info">Read</a>
                                    @if(\Illuminate\Support\Facades\Auth::id() == $b->user->id)
                                        <a href="{{route('blogs.edit', $b->id)}}" class="btn btn-success">Edit</a>
                                        <form class="form-delete" action="{{route('blogs.destroy', $b->id)}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
