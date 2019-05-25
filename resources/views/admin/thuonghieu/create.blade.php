@extends('admin.master')
@section('content')
@section('controller','Thương hiệu')
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
          
          <form name="frmAdd" method="post" action="{{ route('admin.thuonghieu.postCreate') }}" >
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />           
            <div class="clearfix"></div>
            <div class="col-md-6">
              <!-- <div class="form-group">
                <label for="">Tên</label>
                <input type="text" name="txtName" class="form-control" value="">
              </div>
              <div class="form-group">
                <label for="">Đường dẫn tĩnh</label>
                <input type="text" name="txtName" class="form-control" value="">
              </div> -->
              <div class="form-group @if ($errors->first('txtName')!='') has-error @endif">
                    <label for="ten">Tên</label>
                    <input type="text" id="txtName" name="txtName" value=""  class="form-control" />
                    @if ($errors->first('txtName')!='')
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('txtName'); !!}</label>
                    @endif
              </div>
              <div class="form-group @if ($errors->first('txtAlias')!='') has-error @endif">
                    <label for="alias">Đường dẫn tĩnh</label>
                    <input type="text" name="txtAlias" id="txtAlias" value=""  class="form-control" />
                    @if ($errors->first('txtAlias')!='')
                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('txtAlias'); !!}</label>
                    @endif
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
