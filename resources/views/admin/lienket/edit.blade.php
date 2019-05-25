@extends('admin.master')
@section('content')
@section('controller','Quản lý '.$trang)
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
        	<form method="post" action="backend/lienket/edit?id={{$id}}&type={{ @$_GET['type'] }}" enctype="multipart/form-data">
        		<input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        		
      			<div class="row">
              		<div class="col-md-6 col-xs-12">
              		@if($_GET['type']!='catalog')	
						<div class="form-group @if ($errors->first('fImages')!='') has-error @endif">
							<div class="form-group">
								<img src="{{ asset('upload/hinhanh/'.$data->photo) }}" onerror="this.src='{{asset('public/admin_assets/images/no-image.jpg')}}'" style="max-height: 200px;" class="img-responsive"  alt="NO PHOTO" />
								<input type="hidden" name="img_current" value="{!! @$data->photo !!}">
							</div>
							<label for="file">Chọn File ảnh</label>
					     	<input type="file" id="file" name="fImages" >
					    	<p class="help-block">Width:225px - Height: 162px</p>
					    	@if ($errors->first('fImages')!='')
					      	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('fImages'); !!}</label>
					      	@endif
						</div>
					@endif
					@if($_GET['type']=='catalog')
						<div class="form-group @if ($errors->first('document_file')!='') has-error @endif">
		                  <div class="form-group" >
		                    <div class="form-group">
		                      <!-- <img src="{{ asset('upload/banner/'.@$data->image) }}" onerror="this.src='{{asset('public/admin_assets/images/no-image.jpg')}}'" width="200"  alt="NO PHOTO" /> -->
		                      <p style="font-size: 22px;">File: {{$data->document}}</p>
		                      <input type="hidden" name="file_current" value="{!! @$data->document !!}">
		                    </div>
		                    <label for="file">Chọn file</label>
		                      <input type="file" id="file" name="document_file" >
		                      <p style="color: ">(dung lượng file không vượt quá 4MB)</p>
		                       @if ($errors->first('document_file')!='')
		                      <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('document_file'); !!}</label>
		                      @endif
		                  </div>
		                </div>
					@endif

						@if($_GET['type']=='marketing')
						<div class="form-group">
							<div class="form-group">
								<img src="{{ asset('upload/hinhanh/'.$data->photo2) }}" onerror="this.src='{{asset('public/admin_assets/images/no-image.jpg')}}'" style="max-height: 200px;" class="img-responsive"  alt="NO PHOTO" />
								<input type="hidden" name="img_current2" value="{!! @$data->photo2 !!}">
							</div>
							<label for="file">Chọn File ảnh 2</label>
					     	<input type="file" id="file" name="fImages2" >
					    	<p class="help-block">Width:225px - Height: 162px</p>
					    	
						</div>
						@endif
						<div class="clearfix"></div>
						@if($_GET['type']!='quang-cao')
				    	<div class="form-group @if ($errors->first('txtName')!='') has-error @endif">
					      	<label for="ten">Tên</label>
					      	<input type="text" name="txtName" id="txtName" value="{{ $data->name }}"  class="form-control" />
					      	@if ($errors->first('txtName')!='')
					      	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('txtName'); !!}</label>
					      	@endif
						</div>
						@endif
						<!-- <div class="form-group">
					      	<label for="alias">Link liên kết</label>
					      	<input type="text" name="txtLink" id="txtLink" value="{{ $data->link }}"  class="form-control" />
						</div> -->
						<!-- <div class="form-group">
					      	<label for="desc">Mô tả</label>
					      	<textarea name="txtDesc" rows="5" class="form-control">{{ $data->mota }}</textarea>
						</div> -->						
					</div>
					@if($_GET['type']!='quang-cao')
					<div class="col-md-12 col-xs-12">
						<div class="box box-info">
			                <div class="box-header">
			                  	<h3 class="box-title">Nội dung</h3>
			                  	<div class="pull-right box-tools">
				                    <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
				                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				                </div>
			                </div>
			                <div class="box-body pad">
			        			<textarea name="txtContent" id="txtContent" cols="50" rows="5">{{ $data->content }}</textarea>
			        		</div>
			        	</div>			        	
					</div>
					@endif
					<input type="hidden" name="txtCom" value="{{ @$_GET['type'] }}"/>
				</div>
	            <div class="clearfix"></div>
	            <div class="row">
				    <div class="col-md-6">
				    	<div class="form-group hidden">
						      <label for="ten">Số thứ tự</label>
						      <input type="number" min="1" name="stt" value="{!! isset($data->status) ? $data->stt : (count($news)+1) !!}" class="form-control" style="width: 100px;">
					    </div>
					    
					    <div class="form-group hidden">
						    <label>
					        	<input type="checkbox" name="status" {!! (!isset($data->status) || $data->status==1)?'checked="checked"':'' !!}> Hiển thị
					    	</label>
					    </div>
				    	
				    </div>
			    </div>
			    <div class="clearfix"></div>
			    <div class="box-footer">
			    	<div class="row">
						<div class="col-md-6">
					    	<button type="submit" class="btn btn-primary">Cập nhật</button>
					    	<button type="button" class="btn btn-danger" onclick="javascript:window.location='backend/lienket?type={{ @$_GET['type'] }}'">Thoát</button>
				    	</div>
			    	</div>
			  	</div>
		    </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    
</section><!-- /.content -->

@endsection()
