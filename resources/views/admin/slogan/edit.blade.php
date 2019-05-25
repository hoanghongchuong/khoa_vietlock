@extends('admin.master')
@section('content')
@section('controller','Slogan')
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
          
          <form name="frmAdd" method="post" action="{{ asset('backend/slogan/edit/'.$slogan->id) }}" enctype="multipart/form-data" >
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
            <div class="clearfix"></div>
            <div class="form-group @if ($errors->first('fImages')!='') has-error @endif">
                <div class="form-group" >
                  <div class="form-group">
                    <img src="{{ asset('upload/hinhanh/'.@$slogan->photo) }}" onerror="this.src='{{asset('public/admin_assets/images/no-image.jpg')}}'" width="200"  alt="NO PHOTO" />
                    <input type="hidden" name="img_current" value="{!! @$slogan->photo !!}">
                  </div>
                  <label for="file">Chọn File ảnh</label>
                    <input type="file" id="file" name="fImages" >
                    <p class="help-block">Width:225px - Height: 162px</p>
                </div>
            </div>

            <!-- <div class="form-group ">
                <div class="form-group" >
                  <div class="form-group">
                    <img src="{{ asset('upload/hinhanh/'.@$slogan->photo2) }}" onerror="this.src='{{asset('public/admin_assets/images/no-image.jpg')}}'" width="200"  alt="NO PHOTO" />
                    <input type="hidden" name="img_current2" value="{!! @$slogan->photo2 !!}">
                  </div>
                  <label for="file">Chọn File ảnh</label>
                    <input type="file" id="file" name="fImages2" >
                    <p class="help-block">Width:225px - Height: 162px</p>
                </div>
            </div> -->

            <div class="col-md-6">
              <div class="form-group">
                <label for="">Tên</label>
                <input type="text" name="txtName" class="form-control" value="{{$slogan->name}}">
              </div>
              
            </div>
            <!-- <div class="col-md-6">
                <div class="form-group">
                  <label for="">Link</label>
                  <input type="text" name="link" class="form-control" value="{{$slogan->link}}">
                </div>                
            </div> -->
            <div class="col-md-12">
            	<div class="form-group">
	                <label for="">Nội dung</label>
	                <textarea name="content" id="txtContent" cols="30" rows="10">{{$slogan->content}}</textarea>
	              </div>
            </div>
            <div class="form-group hidden">
                <label for="ten">Số thứ tự</label>
                <input type="number" min="1" name="stt" value="{!! isset($slogan->stt) ? $slogan->stt : (count($stt)+1) !!}" class="form-control" style="width: 100px;">
            </div>
          <div class="clearfix"></div>
          <div class="box-footer">
            <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="button" onclick="javascript:window.location='backend/slogan'" class="btn btn-danger">Thoát</button>
              </div>
            </div>
          </div>
        </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    
</section><!-- /.content -->

@endsection()
