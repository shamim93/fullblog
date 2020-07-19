@extends('layouts.backend.dashboard.app')
@section('title')
Blog | Create Category
@endsection
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Create New Category</h1>
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
<div class="col-md-12">


    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><a href="{{route('categories.index')}}" class="btn btn-info">Back To Category List</a></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{route('categories.store')}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Category Name*</label>
                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" id="name" name="name" placeholder="Category Name" value="{{old('name')}}">
                    @if($errors->has('name'))
                        <span class="invalid-feedback">{{$errors->first('name')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}" id="description" placeholder="Description" name="description">{{old('description')}}</textarea>
                    @if($errors->has('description'))
                        <span class="invalid-feedback">{{$errors->first('description')}}</span>
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