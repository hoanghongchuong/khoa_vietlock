@extends('admin.master')
@section('content')
@section('controller','Feedback')
@section('action','Edit')
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
          
          <form name="frmAdd" method="post" action="backend/feedback/edit/{{$data->id}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
            <div class="form-group @if ($errors->first('fImages')!='') has-error @endif">
                <div class="form-group" >
                  <div class="form-group">
                    <img src="{{ asset('upload/hinhanh/'.@$data->photo) }}" onerror="this.src='{{asset('public/admin_assets/images/no-image.jpg')}}'" width="200"  alt="NO PHOTO" />
                    <input type="hidden" name="img_current" value="{!! @$data->photo !!}">
                  </div>
                  <label for="file">Chọn File ảnh</label>
                    <input type="file" id="file" name="fImages" >
                    <p class="help-block">Width:225px - Height: 162px</p>
                </div>
            </div>
            <div class="clearfix"></div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Tên</label>
                <input type="text" name="name" class="form-control" value="{{$data->name}}">
              </div>
              <div class="form-group">
                <label for="">Số điện thoại</label>
                <input type="text" name="content" value="{{$data->content}}" class="form-control" placeholder="">
                
                
              </div>
            </div>
            <!-- <div class="col-md-6">
              <div class="form-group">
                <label for="">Chức vụ</label>
				          <input type="text" name="position" class="form-control" value="{{$data->position}}">		
                
              </div>
            </div> -->
            <!-- <div class="col-md-12">
              <div class="form-group">
                <label for="">Nội dung</label>
                <input type="text" name="content" value="{{$data->content}}" class="form-control" placeholder="">
				        <textarea  name="content" id="txtContent" class="form-control" value="">{{$data->content}}</textarea>	
                
              </div>
            </div> -->
          <div class="clearfix"></div>
          <div class="box-footer">
            <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="button" onclick="javascript:window.location='backend/feedback'" class="btn btn-danger">Thoát</button>
              </div>
            </div>
          </div>
        </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    
</section><!-- /.content -->

@endsection()
