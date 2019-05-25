@extends('admin.master')
@section('content')
@section('controller','Chi nhánh')
@section('action','Add')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    @yield('controller')
    <small>@yield('action')</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="admin"><i class="fa fa-dashboard"></i> Home</a></li>
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
          <form name="frmAdd" method="post" action="{{route('admin.chinhanh.postCreate')}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
              <!-- <div class="form-group col-md-12">
                <label for="file">File ảnh</label>
                  <input type="file" id="file" name="fImages" >
                  <p class="help-block">Width:225px - Height: 162px</p>
              </div>  -->             
              <div class="clearfix"></div>             
            <div class="clearfix"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Tên chi nhánh</label>
                <input type="text" name="txtName" class="form-control" value="">
              </div>
            </div>
            <!-- <div class="col-md-6">
              <div class="form-group">
                <label for="">Số điện thoại</label>
                <input type="text" name="txtPhone" class="form-control" value="">
              </div>
            </div> -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Địa chỉ</label>
                <input type="text" name="txtAddress" class="form-control" value="">
              </div>
            </div>
            <!-- <div class="col-md-6">
              <div class="form-group">
                <label for="">Bản đồ</label>
                <input type="text" name="map" class="form-control" value="">
              </div>
            </div> -->
          <div class="clearfix"></div>
          <div class="box-footer">
            <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="button" onclick="javascript:window.location='backend/chinhanh'" class="btn btn-danger">Thoát</button>
              </div>
            </div>
          </div>
        </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    
</section><!-- /.content -->

@endsection()
