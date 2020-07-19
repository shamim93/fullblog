@extends('layouts.backend.dashboard.app')
@section('title')
Blog | tag List
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">tag List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item {{ Request::is('tags*') ? 'active' : ' '}}"> <a
                            href="{{route('tags.index')}}">tag</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"> <a href="{{route('tags.create')}}" class="btn btn-primary">Create New tag</a>
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Slug</th>


                    <th style="width:40px">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($tags->count())
                @foreach($tags as $tag)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$tag->name}}</td>
                    <td>{{$tag->slug}}</td>

                    <td class="d-flex">
                        <!-- <a href="#" class="btn btn-sm  btn-primary "><i class="fas fa-eye"></i></a> -->

                        <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-sm btn-warning mr-1"><i
                                class="fas fa-edit"></i></a>
                        <form action="{{route('tags.destroy',$tag->id)}}" method="post" class="mr-1">
                            @method('DELETE')
                            @csrf

                            <button type="submit" class="btn btn-sm btn-danger "><i class="fas fa-trash"></i></button>

                        </form>

                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4">
                        <h5 class="text-center">No tags found!</h5>
                    </td>
                </tr>
                @endif


            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    {{$tags->links()}}
</div>
@endsection