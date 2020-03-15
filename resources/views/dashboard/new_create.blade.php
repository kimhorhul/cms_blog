@extends('adminlte::page')

@section('title', (isset($data)? 'Edit' : 'Add News'))

@section('content_header')
<h1>{{isset($data)? 'Edit News' : 'Post a News'}}</h1>
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
        <h3 class="card-title">{{isset($data)? 'Edit News' : 'Post a News'}}</h3>
    </div>

    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" method="POST" enctype="multipart/form-data"
        action="{{isset($data)? route('news.update', $data->id): route('news.store')}}">
        @csrf

        @if (isset($data))
        @method('PUT')
        @endif


        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{isset($data)? $data->title: ''}}">
            </div>
            <div class="form-group">
                <label for="text-editor">Content</label>
                <textarea id="content" class="ck-editor__editable ck-editor__editable_inline"
                    name='content'>{{isset($data)? $data->content: ''}}</textarea>

            </div>
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category" id="category">
                    @foreach ($categories as $categ)
                    <option value="{{$categ->id}}" @if (isset($data)) @if ($categ->id == $data->category_id)
                        selected
                        @endif
                        @endif>


                        {{$categ->title}}</option>

                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Thumnail</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text" name="image" id="image">Upload</span>
                    </div>
                </div>

            </div>
            @if (isset($data))
            <div class="form-group">
                <img src="{{asset('storage/'. $data->image)}}" width='500px' heigh='500px'>
            </div>
            @endif
        </div>

        <!-- /.card-body -->

        <div class="card-footer">
            <button type="Post" class="btn btn-primary">{{isset($data)? 'Update': 'Post'}}</button>
        </div>
    </form>
</div>


<style>
    .ck-editor__editable_inline {
        min-height: 600px;
    }

</style>
<script src="{{asset('ckfinder/ckfinder.js')}}"></script>

<script src="{{asset('ckeditor5-build-classic/ckeditor.js')}}"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'), {
            ckfinder: {
                uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
            },
            toolbar: ['ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'bulletedList',
                'numberedList', 'insertTable', 'blockQuote', 'link', '|', 'undo', 'redo',
            ],
            options: {
                resourceType: 'Images'
            },

        })
        .catch(error => {
            console.error(error);
        });

</script>
@stop
