@extends('adminlte::page')

@section('title', (isset($data)? 'Edit' : 'Add categoy'))

@section('content_header')
<h1>{{isset($data)? 'Edit category' : 'Create category'}}</h1>
@stop

@section('content')
@if ($errors->any())

<div class="alert alert-danger alert-dismissible mb-2">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-ban"></i> Error!</h5>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

@endif
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{isset($data)? 'Edit category' : 'Create a category'}}</h3>
    </div>

    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" method="POST" enctype="multipart/form-data"
        action="{{isset($data)? route('categories.update', $data->id): route('categories.store')}}">
        @csrf

        @if (isset($data))
        @method('PUT')
        @endif


        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    required value="{{isset($data)? $data->title: ''}}">
            </div>
        </div>

        <!-- /.card-body -->

        <div class="card-footer">
            <button type="Post" class="btn btn-primary">{{isset($data)? 'Update': 'Create'}}</button>
        </div>
    </form>
</div>



@stop
