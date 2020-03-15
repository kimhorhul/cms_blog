@extends('adminlte::page')

@section('title', 'Trash')

@section('content_header')
<h1>Trash</h1>
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

        <div class="card card-danger">

            <div class="card-header">
                <h3 class="card-title">All Trashes </h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">



                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill"
                            href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home"
                            aria-selected="true">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill"
                            href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile"
                            aria-selected="false">Category</a>
                    </li>


                </ul>
                <div class="tab-content" id="custom-content-below-tabContent">
                    <div class="tab-pane fade show active pt-3" id="custom-content-below-home" role="tabpanel"
                        aria-labelledby="custom-content-below-home-tab">
                        <table id="categories" class="table table-bordered table-hover ">



                            <thead>
                                <tr>
                                    <th>Thumail</th>
                                    <th>Title</th>
                                    <th>Action</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news as $news)
                                <tr>
                                    <td><img src={{asset('storage/'. $news->image)}} width='60px' heigh='60px'></td>
                                    <td>
                                        {{$news->title}}
                                    </td>

                                    <td>
                                        <div style="display: inline-block">
                                            <form action="{{route('news.restore', $news->id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-warning "><i
                                                        class="fas fa-trash-restore-alt">
                                                    </i>Restore</button>
                                            </form>
                                        </div>
                                        <div style="display: inline-block">
                                            <form action="{{route('news.destroy', $news->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger "><i
                                                        class="fas fa-trash-alt">
                                                    </i>Delete</button>
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
                                    <th>Action</th>

                                </tr>
                            </tfoot>

                        </table>

                    </div>
                    <div class="tab-pane fade pt-3" id="custom-content-below-profile" role="tabpanel"
                        aria-labelledby="custom-content-below-profile-tab">
                        <table id="news" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
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
                                        <div style="display: inline-block">
                                            <form action="{{route('categories.restore', $categories->id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-warning "><i
                                                        class="fas fa-trash-restore-alt">
                                                    </i>Restore</button>
                                            </form>
                                        </div>
                                        <div style="display: inline-block">
                                            <form action="{{route('categories.destroy', $categories->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger "><i class="fas fa-trash-alt">
                                                    </i>Delete</button>
                                            </form>
                                        </div>

                                    </td>


                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Title</th>
                                    <th>Action</th>

                                </tr>
                            </tfoot>

                        </table>

                    </div>


                </div>






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

    $(function () {
        $("#categories").DataTable({

        });
    });


</script>

@stop
