@extends('admin.master')
@section('content')
@section('controller','Color')
@section('action','Add')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    @yield('controller')
    <small>@yield('action')</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="backend"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="javascript:">@yield('controller')</a></li>
    <li class="active">@yield('action')</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  
    <div class="box">
      @include('admin.messages_error')
        <div class="box-body">
          @if (count($errors) > 0)
            <div class="form-group has-error">
              @foreach ($errors->all() as $error)
              <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $error !!}</label><br>
              @endforeach
            </div>
          @endif
          <form name="frmAdd" method="post" action="{{route('admin.color.postCreate')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Tên màu</label>
                <input type="text" name="name" required class="form-control" value="">
              </div>
              <div class="form-group">
                <label for="">Mã màu</label>
                <input type="color" name="code" required class="form-control" value="">
              </div>
            </div>
            
          <div class="clearfix"></div>
          <div class="box-footer">
            <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="button" onclick="javascript:window.location='backend/color'" class="btn btn-danger">Thoát</button>
              </div>
            </div>
          </div>
        </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    
</section><!-- /.content -->

@endsection()
