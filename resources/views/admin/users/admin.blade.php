@extends('admin.master')
@section('content')
@section('controller','Cập nhật tài khoản')
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
        	<form method="post" action="backend/users/updateinfo" enctype="multipart/form-data">
        		<input type="hidden" name="_token" value="{!! csrf_token() !!}" />
          		<div class="row">
              		<div class="col-md-6 col-xs-12">
						<div class="form-group @if ($errors->first('fImages')!='') has-error @endif">
							<div class="form-group">
								<img src="{{ asset('upload/users/'.$data->photo) }}" onerror="this.src='{{asset('public/admin_assets/images/no-image.jpg')}}'" width="200"  alt="NO PHOTO" />
								<input type="hidden" name="img_current" value="{!! @$data->photo !!}">
							</div>
							<label for="file">Chọn File ảnh</label>
					     	<input type="file" id="file" name="fImages" >
					    	<p class="help-block">Width:225px - Height: 162px</p>
					    	@if ($errors->first('fImages')!='')
					      	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('fImages'); !!}</label>
					      	@endif
						</div>
						
						<div class="clearfix"></div>
						<div class="form-group">
					      	<label for="ten">Username</label>
					      	<input type="text" disabled value="{{ $data->username }}"  class="form-control" />
						</div>
						<!-- <div class="form-group @if ($errors->first('txtPassword')!='') has-error @endif">
					      	<label for="ten">Password</label>
					      	<input type="password" name="txtPassword" value=""  class="form-control" />
					      	@if ($errors->first('txtPassword')!='')
					      	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('txtPassword'); !!}</label>
					      	@endif
						</div> -->
						<div class="form-group @if ($errors->first('txtPasswordNew')!='') has-error @endif">
					      	<label for="ten">Password mới</label>
					      	<input type="password" name="txtPasswordNew" value=""  class="form-control" />
					      	@if ($errors->first('txtPasswordNew')!='')
					      	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('txtPasswordNew'); !!}</label>
					      	@endif
						</div>
						<!-- <div class="form-group @if ($errors->first('txtRePassword')!='') has-error @endif">
					      	<label for="ten">Nhập lại password mới</label>
					      	<input type="password" name="txtRePassword" value=""  class="form-control" />
					      	@if ($errors->first('txtRePassword')!='')
					      	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('txtRePassword'); !!}</label>
					      	@endif
						</div> -->
				    	<div class="form-group  @if ($errors->first('txtName')!='') has-error @endif">
					      	<label for="ten">Họ tên</label>
					      	<input type="text" name="txtName" value="{{ $data->name }}"  class="form-control" />
					      	@if ($errors->first('txtName')!='')
					      	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('txtName'); !!}</label>
					      	@endif
						</div>
						<div class="form-group">
					      	<label for="alias">Email</label>
					      	<input type="email" name="txtEmail" id="txtEmail" value="{{ $data->email }}"  class="form-control" />
						</div>
						<div class="form-group">
					      	<label for="alias">Điện thoại</label>
					      	<input type="text" name="txtPhone" id="txtPhone" value="{{ $data->phone }}"  class="form-control" />
						</div>
						<div class="form-group">
					      	<label for="alias">Địa chỉ</label>
					      	<input type="text" name="txtAddress" id="txtAddress" value="{{ $data->address }}"  class="form-control" />
						</div>

					</div>
					<div class="col-md-6 col-xs-12"></div>
				</div>
			    <div class="clearfix"></div>
			    <div class="box-footer">
			    	<div class="row">
						<div class="col-md-6">
					    	<button type="submit" class="btn btn-primary">Cập nhật</button>
					    	<button type="button" class="btn btn-danger" onclick="javascript:window.location='admin'">Thoát</button>
				    	</div>
			    	</div>
			  	</div>
		    </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    
</section><!-- /.content -->
@endsection()


<!-- <script language="javascript" src="media/scripts/my_script.js"></script>
<script language="javascript">
function js_submit(){
	if(isEmpty(document.frm.username, "Chưa nhập tên đăng nhập.")){
		return false;
	}
	
	if(isEmpty(document.frm.oldpassword, "Chưa nhập mật khẩu cũ.")){
		return false;
	}
	
	if(!isEmpty(document.frm.new_pass) && document.frm.new_pass.value.length<5){
		alert("Mật khẩu phải nhiều hơn 4 ký tự.");
		document.frm.new_pass.focus();
		return false;
	}
	
	if(!isEmpty(document.frm.new_pass) && document.frm.new_pass.value!=document.frm.renew_pass.value){
		alert("Nhập lại mật khẩu mới không chính xác.");
		document.frm.renew_pass.focus();
		return false;
	}
	
	if(!isEmpty(document.frm.email) && !check_email(document.frm.email.value)){
		alert('Email không hợp lệ.');
		document.frm.email.focus();
		return false;
	}
}
</script> -->
