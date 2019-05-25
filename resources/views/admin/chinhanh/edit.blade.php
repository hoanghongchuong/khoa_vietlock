@extends('admin.master')
@section('content')
@section('controller','Chi nhánh')
@section('action','Edit')
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
          
          <form name="frmAdd" method="post" action="{{asset('backend/chinhanh/edit/'.$chinhanh->id)}}" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
              
              <!-- <div class="col-md-12">
                <div class="form-group @if ($errors->first('fImages')!='') has-error @endif">
                  <div class="form-group">
                    <img src="{{ asset('upload/hinhanh/'.$chinhanh->photo) }}" onerror="this.src='{{asset('public/admin_assets/images/no-image.jpg')}}'" width="200"  alt="NO PHOTO" />
                    <input type="hidden" name="img_current" value="{!! @$chinhanh->photo !!}">
                  </div>
                  <label for="file">Chọn File ảnh</label>
                    <input type="file" id="file" name="fImages" >
                    <p class="help-block">Width:225px - Height: 162px</p>
                    
                </div>    
              </div>  -->             
              <div class="clearfix"></div>
              <div class="col-md-6">

                <div class="form-group">
                  <label for="">Tên chi nhánh</label>
                  <input type="text" name="txtName" class="form-control" value="{{$chinhanh->name}}">
                </div>
                <div class="form-group">
                  <label for="">Địa chỉ</label>
                  <input type="text" name="txtAddress" class="form-control" value="{{$chinhanh->address}}">
                </div>
                <!-- <div class="form-group">
                  <label for="">Số điện thoại</label>
                  <input type="text" name="txtPhone" class="form-control" value="{{$chinhanh->phone}}">
                </div> -->
              </div>
              
              <div class="col-md-6">
                <!-- <div class="form-group">
                  <label for="">Bản đồ</label>
                  <input type="text" name="map" class="form-control" value="{{$chinhanh->map}}">
                </div> -->
              </div>
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
