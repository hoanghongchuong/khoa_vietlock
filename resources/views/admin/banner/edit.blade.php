@extends('admin.master')
@section('content')
@section('controller','Bài viết '.'Banner')
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
          
          <form name="frmAdd" method="post" action="backend/banner/edit/{{$data->id}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
            <div class="form-group @if ($errors->first('fImages')!='') has-error @endif">
                <div class="form-group" >
                  <div class="form-group">
                    <img src="{{ asset('upload/banner/'.@$data->image) }}" onerror="this.src='{{asset('public/admin_assets/images/no-image.jpg')}}'" width="200"  alt="NO PHOTO" />
                    <input type="hidden" name="img_current" value="{!! @$data->image !!}">
                  </div>
                  <label for="file">Chọn File ảnh</label>
                    <input type="file" id="file" name="fImages" >
                    <p class="help-block">Width:225px - Height: 162px</p>
                </div>
            </div>
              
            <div class="clearfix"></div>
            
            <!-- <div class="col-md-6">
              <div class="form-group">
                <label for="">Link</label>
                <input type="text" name="txtLink" class="form-control" value="{{$data->link}}">
              </div>
              <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" value="{{$data->title}}">
              </div>
              <div class="form-group">
                <label for="">Mô tả</label>
                <textarea name="mota" id="" crows="5" class="form-control" value="{{$data->mota}}"></textarea>
              </div>
            </div> -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Trang</label>
                <select name="position" class="form-control" id="">
                  @foreach($position as $item)
                  <option value="{{ $item['id'] }}" @if($data['position'] == $item['id']) selected @endif>{!! $item['name'] !!}</option>
                  @endforeach
                </select>
              </div>
            </div>
          <div class="clearfix"></div>
          <div class="box-footer">
            <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="button" onclick="javascript:window.location='backend/banner'" class="btn btn-danger">Thoát</button>
              </div>
            </div>
          </div>
        </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    
</section><!-- /.content -->

@endsection()
