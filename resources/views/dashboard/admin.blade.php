@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
        <h3>{{$article->count()}}</h3>

          <p>Article</p>
        </div>
        <div class="icon">
          <i class="far fa-fw fa-file"></i>
        </div>
    <a href="{{route('news.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
        <h3>{{$categ->count()}}</h3>

          <p>Category</p>
        </div>
        <div class="icon">
          <i class="far fa-fw fa-list-alt"></i>
        </div>
    <a href="{{route('categories.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <!-- ./col -->
  </div>


@stop