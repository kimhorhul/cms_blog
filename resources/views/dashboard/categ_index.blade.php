@extends('adminlte::page')

@section('title', 'Category')

@section('content_header')
<h1>Categories</h1>
@stop

@section('content')

<style>
    .table td,
    .table th {
        vertical-align: middle;
    }

</style>
<div class="row">

    <div class="col-12">
        <div class="d-flex flex-row-reverse mb-1">
            <a href="{{route('categories.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Add
                category</a>
        </div>
        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">All categories </h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <table id="categories" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Article Count</th>
                            <th>Action</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categ as $categories)
                        <tr>

                            <td>
                                {{$categories->title}}
                            </td>
                            <td>
                                {{$categories->news->count()}}
                            </td>


                            <td>
                                <div style="display: inline-block">
                                    <a href="{{route('categories.edit', $categories->id)}}" class="btn btn-success "><i
                                            class="fas fa-pencil-alt">
                                        </i>Edit</a>
                                </div>
                                <div style="display: inline-block">
                                    <form action="{{route('categories.destroy', $categories->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger "><i class="fas fa-trash-alt">
                                            </i>Trash</button>
                                    </form>
                                </div>

                            </td>


                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Article Count</th>
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
        $("#categories").DataTable({

        });
    });

</script>

@stop
