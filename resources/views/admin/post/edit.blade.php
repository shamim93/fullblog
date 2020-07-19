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
        <form action="{{route('posts.update', $post->id)}}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Post Title*</label>
                    <input type="text" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" id="title"
                        name="title" placeholder="Post Title" value="{{$post->title}}">
                    @if($errors->has('title'))
                    <span class="invalid-feedback">{{$errors->first('title')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">Description*</label>
                    <textarea class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="description"
                        placeholder="Description" name="description">{{$post->description}}</textarea>
                    @if($errors->has('description'))
                    <span class="invalid-feedback">{{$errors->first('description')}}</span>
                    @endif

                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-7">
                            <label for="image">Image*</label>
                            <input type="file" class="form-control {{$errors->has('image') ? 'is-invalid' : ''}}"
                                id="image" placeholder="" name="image" value="{{old('image')}}">
                        </div>


                        <div class="col-md-3">
                            <div style="max-width: 150px; max-height:150px;overflow:hidden">
                                <!-- <img src="{{asset($post->image)}}" class="img-fluid img-rounded" alt=""> -->
                                <img src="{{Storage::url('post-image/'.$post->image)}}" class="img-fluid img-rounded"
                                    alt="">

                            </div>
                        </div>
                    </div>


                    @if($errors->has('image'))
                    <span class="invalid-feedback">{{$errors->first('image')}}</span>
                    @endif

                </div>
                <div class="form-group">
                    <label for="category">Category*</label>

                    <select name="category[]" class="form-control {{$errors->has('category') ? 'is-invalid' : ''}}"
                        id="category" value="{{old('category[]')}}" multiple>
                        @foreach($categories as $category)
                        <option @if(in_array($category->id,$post->categories->pluck('id')->toArray())) selected @endif
                            value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>


                    @if($errors->has('category'))
                    <span class="invalid-feedback">{{$errors->first('category')}}</span>
                    @endif

                </div>
                <div class="form-group">
                    <label for="category">Tags*</label>

                    <select name="tag[]" class="form-control {{$errors->has('tag') ? 'is-invalid' : ''}}"
                        id="tag" value="{{old('tag[]')}}" multiple>
                        @foreach($tags as $tag)
                        <option 
                            @foreach($post->tags as $postTag)
                            @if($postTag->id == $tag->id)
                                selected
                                @endif
                            @endforeach
                            value="{{$tag->id}}">{{$tag->name}}
                        </option>
                        @endforeach
                    </select>


                    @if($errors->has('category'))
                    <span class="invalid-feedback">{{$errors->first('category')}}</span>
                    @endif

                </div>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection