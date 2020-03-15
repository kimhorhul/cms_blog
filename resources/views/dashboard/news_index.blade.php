@extends('adminlte::page')

@section('title', 'Article')

@section('content_header')
<h1>News</h1>
@stop

@section('content')

<style>
 .table td, .table th{
    vertical-align: middle;
 }

</style>
<div class="row">

    <div class="col-12">
        <div class="d-flex flex-row-reverse mb-1">
            <a href="{{route('news.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Add Article</a>
        </div>
        <div class="card card-success">

            <div class="card-header">
                <h3 class="card-title">All articles </h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <table id="news" class="table table-bordered table-hover">



                    <thead>
                        <tr>
                            <th>Thumail</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($new as $news)
                        <tr>
                            <td><img src={{asset('storage/'. $news->image)}} width='60px' heigh='60px'></td>
                            <td>
                                {{$news->title}}
                            </td>
                            <td>
                                {{$news->category->title}}
                            </td>

                            <td>
                                <div style="display: inline-block">
                                    <a href="{{route('news.edit', $news->id)}}" class="btn btn-success "><i
                                        class="fas fa-pencil-alt">
                                    </i>Edit</a>
                                </div>
                                <div style="display: inline-block">
                                    <form action="{{route('news.destroy', $news->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger "><i class="fas fa-trash-alt">
                                            </i>Trash</button>
                                    </form>
                                </div>


                                {{-- <a href="{{route('news.destroy', $news->id)}}"
                                class="btn btn-danger "><i class="fas fa-trash-alt">
                                </i>Delete</a> --}}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Thumail</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>

                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

</div>
@stop

@section('js')
<script>
    $(function () {
        $("#news").DataTable({

        });
    });

</script>

@stop
