@extends('admin.master')
@section('content')
@section('controller','Order Detail')
@section('action','Update')

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
        	<form method="post" action="admin/orders/edit?id={{$id}}" enctype="multipart/form-data">
        		<input type="hidden" name="_token" value="{!! csrf_token() !!}" />
      			<div class="nav-tabs-custom">
	                <ul class="nav nav-tabs">
	                  	<li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Thông tin chung</a></li>
	                  	<li><a href="#tab_2" data-toggle="tab" aria-expanded="true">Chi tiết đơn hàng</a></li>
	                </ul>
	                <div class="tab-content">
	                  	<div class="tab-pane active" id="tab_1">
	                  		<div class="row">
		                  		<div class="col-md-6 col-xs-12">
							    	<div class="form-group">
								      	<label for="ten">Họ tên</label>
								      	<input type="text" disabled id="txtName" value="{!! old('txtName', isset($data) ? $data->name : null) !!}"  class="form-control" />
									</div>
									<div class="form-group">
								      	<label for="txtTitle">Email</label>
								      	<input type="text"  disabled value="{!! old('txtEmail', isset($data) ? $data->email : null) !!}"  class="form-control" />
									</div>
									<div class="form-group">
								      	<label for="txtPhone">Điện thoại</label>
								      	<input type="text" disabled value="{!! old('txtPhone', isset($data) ? $data->phone : null) !!}"  class="form-control" />
									</div>
									<div class="form-group">
								      	<label for="txtAddress">Địa chỉ</label>
								      	<input type="text"  disabled value="{!! old('txtAddress', isset($data) ? $data->address : null) !!}"  class="form-control" />
									</div>
									<div class="form-group">
								      	<label for="content">Nội dung</label>
								      	<textarea  rows="5" disabled class="form-control">{!! old('txtContent', isset($data) ? $data->content : null) !!}</textarea>
									</div>

								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
								      	<label for="ten">Tình trạng đơn hàng</label>
								      	<select name="status" class="form-control">
								      		@foreach($tinhtrang as $item)
								      		<option value="{!!$item->id!!}" <?php if($data->status==$item->id) echo 'selected';?> >{!!$item->name!!}</option>
								      		@endforeach
								      	</select>
									</div>
									<div class="form-group">
								      	<label for="note">Ghi chú đơn hàng</label>
								      	<textarea name="txtNote" rows="5" class="form-control">{!! old('txtNote', isset($data) ? $data->note : null) !!}</textarea>
									</div>

								</div>
							</div>
							<div class="clearfix"></div>
	                  	</div><!-- /.tab-pane -->
	                  	<div class="tab-pane" id="tab_2">
	                  		<div class="box-body">
					          <table id="example2" class="table table-bordered table-hover">
					            <thead>
					              <tr>
					                <th style="width: 20px;"><input type="checkbox" name="chonhet" class="minimal" id="chonhet" /></th>
					                <th class="text-center with_dieuhuong">Stt</th>
					                <th>Tên sản phẩm</th>
					                <th>Đơn giá</th>
					                <th>Số lượng</th>
					                <th>Tổng tiền</th>
					              </tr>
					            </thead>
					            <tbody>
					              @foreach($products as $k=>$item)
					              <tr>
					                <td><input type="checkbox" name="chon" id="chon" value="{{$item->id}}" class="chon" /></td>
					                <td class="text-center with_dieuhuong">{{$k+1}}</td>
					                
					                <td>
						                <?php  
						                	$product = DB::table('products')->where('id', $item->id_product)->first();
						                ?>
						                {!! $product->name !!}
					                </td>
					                <td>{{ number_format($item->totalprice/$item->qty,0,",",".") }}</td>
					                <td>{{$item->qty}}</td>
					                <td>{{ number_format($item->totalprice,0,",",".") }}</td>
					              </tr>
					              @endforeach
					            </tbody>
					          </table>
					        </div><!-- /.box-body -->
					        <div class="form-group">
					        	<h4>Tổng thành tiền: <b>{{ number_format($data->total,0,",",".") }} VNĐ</b></h4>
					        </div>
	                    	<div class="clearfix"></div>
	                	</div><!-- /.tab-pane -->
	                </div><!-- /.tab-content -->
	            </div>
			    <div class="clearfix"></div>
			    <div class="box-footer col-md-12 row">
					<div class="col-md-6">
				    	<button type="submit" class="btn btn-primary">Cập nhật</button>
				    	<button type="button" onclick="javascript:window.location='admin/orders'" class="btn btn-danger">Thoát</button>
			    	</div>
			  	</div>
		    </form>
        </div><!-- /.box-body -->
    </div><!-- /box -->
    
</section><!-- /.content -->
@endsection()
