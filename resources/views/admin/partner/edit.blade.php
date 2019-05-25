@extends('admin.master')
@section('content')
@section('controller','Đối tác')
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
          
          <form name="frmAdd" method="post" action="backend/partner/edit/{{$data->id}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
            <div class="form-group @if ($errors->first('fImages')!='') has-error @endif">
              <div class="form-group">
                <img src="{{ asset('upload/banner/'.$data->photo) }}" onerror="this.src='{{asset('public/admin_assets/images/no-image.jpg')}}'" class="img-responsive"  alt="NO PHOTO" />
                <input type="hidden" name="img_current" value="{!! @$data->photo !!}">
              </div>
              <label for="file">Chọn File ảnh</label>
                <input type="file" id="file" name="fImages" >
                <p class="help-block">Width:800px - Height: 326px</p>
                @if ($errors->first('fImages')!='')
                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('fImages'); !!}</label>
                  @endif
            </div>
              
            <div class="clearfix"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Tên</label>
                <input type="text" name="name" class="form-control" value="{{$data->name}}">
               
              </div>
              <!-- <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control" value="{{$data->email}}">
              </div>
               <div class="form-group">
                <label for="">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" value="{{$data->phone}}">
              </div> -->
            </div>
            <!-- <div class="col-md-6">
              <div class="form-group">
                <label for="">Link</label>
                <input type="text" name="txtLink" class="form-control" value="{{$data->url}}">
              </div>
            </div> -->
            
          <div class="clearfix"></div>
          <div class="box-footer">
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                  <label>
                      <input type="checkbox" name="status" {!! (!isset($data->status) || $data->status==1)?'checked="checked"':'' !!}> Hiển thị
                  </label>
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="button" onclick="javascript:window.location='backend/partner'" class="btn btn-danger">Thoát</button>
              </div>
            </div>
          </div>
        </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    
</section><!-- /.content -->

@endsection()
