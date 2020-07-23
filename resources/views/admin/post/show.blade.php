@extends('layouts.backend.dashboard.app')
@section('title')
Blog | post List
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Post Details</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item {{ Request::is('posts*') ? 'active' : ' '}}"> <a
                            href="{{route('posts.index')}}">post</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"> <a href="{{route('posts.index')}}" class="btn btn-primary">Back To Post List</a>
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="container">
        <h4>Post Title:</h4>
        <p>{{$post->title}}</p>
        <h4>Post Description:</h4>
        <p>{!!$post->description!!}</p>
        <h4>Post Author:</h4>
        <p>{{$post->user->name}}</p>
        <h4>Post Categories:</h4>
        @foreach($post->categories as $category)
        <span class="badge badge-primary">{{$category->name}}</span>
        @endforeach
        <h4>Post Tags:</h4>
        @foreach($post->tags as $tag)
        <span class="badge badge-primary">{{$tag->name}}</span>
        @endforeach
        </div>
    </div>
    <!-- /.card-body -->

</div>
@endsection