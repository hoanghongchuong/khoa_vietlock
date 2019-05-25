@extends('admin.master')
@section('content')
@section('controller','Sửa bài '.$trang)
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
        	<form method="post" id="frmEditNews" action="backend/news/edit?id={{$id}}&type={{ @$_GET['type'] }}" enctype="multipart/form-data">
        		<input type="hidden" name="_token" value="{!! csrf_token() !!}" />
        		
      			<div class="nav-tabs-custom">
	                <ul class="nav nav-tabs">
	                  	<li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Thông tin chung</a></li>
	                  	<li><a href="#tab_2" data-toggle="tab" aria-expanded="true">Nội dung</a></li>
	                  	@if($_GET['type']=='du-an')
	                  	<li><a href="#tab_3" data-toggle="tab" aria-expanded="true">Album ảnh</a></li>
	                  	@endif
	                  	<li><a href="#tab_4" data-toggle="tab" aria-expanded="true">SEO</a></li>
	                </ul>
	                <div class="tab-content">
	                  	<div class="tab-pane active" id="tab_1">
	                  		<div class="row">
		                  		<div class="col-md-6 col-xs-12">
		                  			
		                  			<div class="form-group @if ($errors->first('fImages')!='') has-error @endif">
										<div class="form-group">
											<img src="{{ asset('upload/news/'.$data->photo) }}" onerror="this.src='{{asset('public/admin_assets/images/no-image.jpg')}}'" width="200"  alt="NO PHOTO" />
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
									@if($_GET['type']=='dich-vu')
									<div class="form-group">
								      	<label for="ten">Danh mục bài viết</label>
								      	<select name="txtNewsCate" class="form-control">

								      		<option value="0">Chọn danh mục</option>
								      		<?php cate_parent($parent,0,"--",$data->cate_id) ?>
								      	</select>
									</div>
									@endif
							    	<div class="form-group @if ($errors->first('txtName')!='') has-error @endif">
								      	<label for="ten">Tên</label>
								      	<input type="text" name="txtName" id="txtName" value="{{ $data->name }}"  class="form-control" />
								      	@if ($errors->first('txtName')!='')
								      	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('txtName'); !!}</label>
								      	@endif
									</div>
									<div class="form-group @if ($errors->first('txtAlias')!='') has-error @endif">
								      	<label for="alias">Đường dẫn tĩnh</label>
								      	<input type="text" name="txtAlias" id="txtAlias" value="{{ $data->alias }}"  class="form-control" />
								      	@if ($errors->first('txtAlias')!='')
								      	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('txtAlias'); !!}</label>
								      	@endif
									</div>
									@if($_GET['type']!='gioi-thieu')
									<div class="form-group">
								      	<label for="desc">Mô tả</label>
								      	<textarea name="txtDesc" rows="5" class="form-control">{{ $data->mota }}</textarea>
									</div>
									@endif
								</div>
								<!-- <div class="col-md-6 col-xs-12">
									@if($_GET['type']!='tin-tuc' && $_GET['type']!='tuyen-dung')
									<div class="form-group @if ($errors->first('fImagesBg')!='') has-error @endif">
										<div class="form-group">
											<div class="img_backgound">
												<img src="{{ asset('upload/news/'.$data->background) }}" onerror="this.src='{{asset('public/admin_assets/images/no-image.jpg')}}'" width="200"  alt="NO PHOTO" />
												<input type="hidden" name="img_current2" value="{!! @$data->background !!}">
												@if(!empty($data->background))
												<a href="{!! asset('backend/news/edit?id='.$id.'&type='.@$_GET['type'].'&delete_bg='.@$data->background) !!}" class="img_bg"><img src="{!! asset('public/admin_assets/images/del.png') !!}" alt="Xóa hình"></a>
												@endif
											</div>
										</div>
										<label for="file">Chọn background</label>
								     	<input type="file" id="file" name="fImagesBg" >
								    	<p class="help-block">Width:225px - Height: 162px</p>
								    	@if ($errors->first('fImagesBg')!='')
								      	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {!! $errors->first('fImagesBg'); !!}</label>
								      	@endif
									</div>
									@endif
									
								</div> -->
								<input type="hidden" name="txtCom" value="{{ @$_GET['type'] }}"/>
							</div>
							<div class="clearfix"></div>
	                  	</div><!-- /.tab-pane -->
	                  	<div class="tab-pane" id="tab_2">
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
	                    	<div class="clearfix"></div>
	                	</div><!-- /.tab-pane -->
	                	<div class="tab-pane" id="tab_3">
	                		<div class="form-group">
	                			@foreach($news_img as $key => $item)
		                        <div class="form-group" id="{!! $key !!}">
		                            <img src="{!! asset('upload/albumnews/'.$item['photo']) !!}" style="max-width: 150px; margin: 20px;" idImg="{!! $item['id'] !!}" id="{!! $key !!}">
		                            <a href="javascript:" type="button" id="del_img_news" class="btn btn-danger btn-circle icon_del"><i class="fa fa-times"></i></a>
		                        </div>
		                      @endforeach
	                  			<label class="control-label">Chọn ảnh</label>
                      			<input id="input-2" name="detailImg[]" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" data-allowed-file-extensions='["jpeg", "jpg", "png", "gif"]'>
	                  		</div>
	                  	</div>
	                	<div class="tab-pane" id="tab_4">
	                  		<div class="row">
		                    	<div class="col-md-6 col-xs-12">
		                    		<div class="form-group">
								      	<label for="title">Title</label>
								      	<input type="text" name="txtTitle" value="{{ $data->title }}"  class="form-control" />
									</div>
		                    		<div class="form-group">
								      	<label for="keyword">Keyword</label>
								      	<textarea name="txtKeyword" rows="5" class="form-control">{{ $data->keyword }}</textarea>
									</div>
									<div class="form-group">
								      	<label for="description">Description</label>
								      	<textarea name="txtDescription" rows="5" class="form-control">{{ $data->description }}</textarea>
									</div>
		                    	</div>
	                    	</div>
	                    	<div class="clearfix"></div>
	                	</div><!-- /.tab-pane -->
	                </div><!-- /.tab-content -->
	            </div>
	            <div class="clearfix"></div>				
			    <div class="col-md-6">
			    	<div class="form-group hidden">
					      <label for="ten">Số thứ tự</label>
					      <input type="number" min="1" name="stt" value="{!! isset($data->stt) ? $data->stt : (count($news)+1) !!}" class="form-control" style="width: 100px;">
				    </div>				    
				    <div class="form-group">
					    <label>
				        	<input type="checkbox" name="status" {!! (!isset($data->status) || $data->status==1)?'checked="checked"':'' !!}> Hiển thị
				    	</label>
				    </div>
				    @if($_GET['type']!='bai-viet')
				    <div class="form-group">
					    <label>
				        	<input type="checkbox" name="noibat" {{ ($data->noibat==1)?'checked="checked"':'' }}> 
				        	Nổi bật
				    	</label>
					</div>
					@endif
					<!-- @if($_GET['type']!='tin-tuc' && $_GET['type']!='tuyen-dung')
			    	<div class="form-group">
					    <label>
				        	<input type="checkbox" name="home" {{ ($data->home==1)?'checked="checked"':'' }}> Hiển thị trang chủ
				    	</label>
				    </div>
				    @endif -->
			    </div>
			    <div class="clearfix"></div>
			    <div class="box-footer">
			    	<div class="row">
						<div class="col-md-6">
					    	<button type="submit" class="btn btn-primary">Cập nhật</button>
					    	<button type="button" class="btn btn-danger" onclick="javascript:window.location='backend/news?type={{ @$_GET['type'] }}'">Thoát</button>
				    	</div>
			    	</div>
			  	</div>
		    </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    
</section><!-- /.content -->

@endsection()
