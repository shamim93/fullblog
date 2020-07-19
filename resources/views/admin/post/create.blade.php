@extends('layouts.backend.dashboard.app')
@section('title')
Blog | Create post
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Create New post</h1>
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
<div class="col-md-12">


    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><a href="{{route('posts.index')}}" class="btn btn-info">Back To post List</a></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Post Title*</label>
                    <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" id="title"
                        name="title" placeholder="Post Title" value="{{old('title')}}">
                    @if($errors->has('title'))
                    <span class="invalid-feedback">{{$errors->first('title')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">Description*</label>
                    <textarea class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="description"
                        placeholder="Description" name="description">{{old('description')}}</textarea>
                    @if($errors->has('description'))
                    <span class="invalid-feedback">{{$errors->first('description')}}</span>
                    @endif

                </div>
                <div class="form-group">
                    <label for="image">Image*</label>
                    <input type="file" class="form-control {{$errors->has('image') ? 'is-invalid' : ''}}" id="image"
                        placeholder="" name="image" value="{{old('image')}}">
                    @if($errors->has('image'))
                    <span class="invalid-feedback">{{$errors->first('image')}}</span>
                    @endif

                </div>
                <div class="form-group">
                    <label for="category">Categories*</label>

                    <select name="category[]" class="form-control {{$errors->has('category') ? 'is-invalid' : ''}}"
                        id="category" value="{{old('category[]')}}" multiple>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>


                    @if($errors->has('category'))
                    <span class="invalid-feedback">{{$errors->first('category')}}</span>
                    @endif

                </div>
                <div class="form-group">
                    <label for="tag">Tags*</label>

                    <select name="tag[]" class="form-control {{$errors->has('tag') ? 'is-invalid' : ''}}"
                        id="tag" value="{{old('tag[]')}}" multiple>
                        @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>


                    @if($errors->has('tag'))
                    <span class="invalid-feedback">{{$errors->first('tag')}}</span>
                    @endif

                </div>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection