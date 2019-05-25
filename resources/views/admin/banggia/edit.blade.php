@extends('admin.master')
@section('content')
@section('controller','Bảng giá')
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
          
            <form name="frmAdd" method="post" action="backend/banggia/edit/{{$data->id}}" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
              <div class="clearfix"></div>
              <div class="col-md-6">
                <div class="form-group @if ($errors->first('txtName')!='') has-error @endif">
                      <label for="ten">Tên</label>
                      <input type="text" id="txtName" name="txtName" value="{{$data->name}}"  class="form-control" />
                      @if ($errors->first('txtName')!='')
                      <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('txtName'); !!}</label>
                      @endif
                </div>
                <div class="form-group @if ($errors->first('txtAlias')!='') has-error @endif">
                      <label for="alias">Đường dẫn tĩnh</label>
                      <input type="text" name="txtAlias" id="txtAlias" value="{{$data->alias}}"  class="form-control" />
                      @if ($errors->first('txtAlias')!='')
                      <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('txtAlias'); !!}</label>
                      @endif
                </div>
                <!-- <div class="form-group">
                        <input type="file" name="filesTest" required="true">
                        <br/>
                </div> -->
                <div class="form-group @if ($errors->first('filesTest')!='') has-error @endif">
                  <div class="form-group" >
                    <div class="form-group">
                      <!-- <img src="{{ asset('upload/banner/'.@$data->image) }}" onerror="this.src='{{asset('public/admin_assets/images/no-image.jpg')}}'" width="200"  alt="NO PHOTO" /> -->
                      <p style="font-size: 22px;">File: {{$data->doc}}</p>
                      <input type="hidden" name="file_current" value="{!! @$data->doc !!}">
                    </div>
                    <label for="file">Chọn file</label>
                      <input type="file" id="file" name="filesTest" >
                      <p style="color: ">(dung lượng file không vượt quá 10MB)</p>
                       @if ($errors->first('filesTest')!='')
                      <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('filesTest7sadasadsda'); !!}</label>
                      @endif
                  </div>
              </div>
              </div>
              <div class="col-md-12">
                  <div class="form-group">
                        <label for="desc">Nội dung</label>
                        <textarea name="content" rows="5" id="txtContent" class="form-control">{{$data->content}}</textarea>
                  </div>
              </div>  
            <div class="clearfix"></div>
            <div class="box-footer">
              <div class="row">
              <div class="col-md-6">
                  <button type="submit" class="btn btn-primary">Lưu</button>
                  <button type="button" onclick="javascript:window.location='backend/banggia'" class="btn btn-danger">Thoát</button>
                </div>
              </div>
            </div>
          </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    
</section><!-- /.content -->

@endsection()
