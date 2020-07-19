@extends('layouts.backend.dashboard.app')
@section('title')
Blog | post List
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">post List</h1>
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
        <h3 class="card-title"> <a href="{{route('posts.create')}}" class="btn btn-primary">Create New post</a>
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>

                    <th>#</th>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Tags</th>
                    <th>Author</th>


                    <th style="width:40px">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($posts->count())
                @foreach($posts as $post)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>
                        <div style="max-width: 150px; max-height:150px;overflow:hidden">
                            <!-- <img src="{{asset($post->image)}}" class="img-fluid img-rounded" alt=""> -->
                            <img src="{{Storage::url('post-image/'.$post->image)}}" class="img-fluid img-rounded"
                                alt="">

                        </div>
                    </td>
                    <td>{{$post->title}}</td>

                    <td>
                        @foreach($post->categories as $category)
                        <span>{{$category->name}} </span>
                        @if(!$loop->last)
                        ,
                        @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($post->tags as $tag)
                        <span>{{$tag->name}} </span>
                        @if(!$loop->last)
                        ,
                        @endif
                        @endforeach
                    </td>

                    <td>{{$post->user->name}}</td>

                    <td class="d-flex">
                        <a href="{{route('posts.show',$post->id)}}" class="btn btn-sm  btn-primary "><i
                                class="fas fa-eye"></i></a>

                        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-sm btn-warning mr-1"><i
                                class="fas fa-edit"></i></a>
                        <form action="{{route('posts.destroy',$post->id)}}" method="post" class="mr-1">
                            @method('DELETE')
                            @csrf

                            <button type="submit" class="btn btn-sm btn-danger "><i class="fas fa-trash"></i></button>

                        </form>

                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="7">
                        <h5 class="text-center">No posts found!</h5>
                    </td>
                </tr>
                @endif


            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    {{$posts->links()}}
</div>
@endsection