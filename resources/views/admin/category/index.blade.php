@extends('layouts.backend.dashboard.app')
@section('title')
Blog | Category List
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Category List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item {{ Request::is('categories*') ? 'active' : ' '}}"> <a
                            href="{{route('categories.index')}}">Category</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"> <a href="{{route('categories.create')}}" class="btn btn-primary">Create New Category</a>
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
                @if($categories->count())
                @foreach($categories as $category)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->slug}}</td>
                   
                    <td class="d-flex">
                       
                       
                        <a href="{{route('categories.edit',$category->id)}}" class="btn btn-sm btn-warning mr-1"><i class="fas fa-edit"></i></a>
                        <form action="{{route('categories.destroy',$category->id)}}" method="post" class="mr-1">
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
    {{$categories->links()}}
</div>
@endsection