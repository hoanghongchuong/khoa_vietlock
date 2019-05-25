@extends('admin.master')
@section('content')
@section('controller','Bài viết '.'Huyện')
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
          
          <form name="frmAdd" method="post" action="{{ route('admin.district.postCreate') }}" >
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                          
            <div class="clearfix"></div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Tên</label>
                <input type="text" name="txtName" class="form-control" value="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Tỉnh/ thành phố</label>
                  <select name="province" id="" class="form-control">
                    <option value="">--Chọn tỉnh/ thành phố---</option>
                    @foreach($province as $pro)
                    <option value="{{$pro->id}}">{{$pro->province_name}}</option>
                    @endforeach
                  </select>
              </div>
            </div>
          <div class="clearfix"></div>
          <div class="box-footer">
            <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="button" onclick="javascript:window.location=''" class="btn btn-danger">Thoát</button>
              </div>
            </div>
          </div>
        </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    
</section><!-- /.content -->

@endsection()
