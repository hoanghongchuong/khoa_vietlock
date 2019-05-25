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
        	<form method="post" action="{{asset('backend/orders/edit/'.$data->id)}}" >
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
								      	<input type="text" disabled id="txtName" value="{!! old('txtName', isset($data) ? $data->full_name : null) !!}"  class="form-control" />
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
									<!-- <div class="form-group">
								      	<label for="content">Nội dung</label>
								      	<textarea  rows="5" disabled class="form-control">{!! old('txtContent', isset($data) ? $data->content : null) !!}</textarea>
									</div> -->

								</div>
								<div class="col-md-6 col-xs-12">
									<div class="form-group">
										<label for="">Ghi chú</label>
										<div class="">
											<textarea name="" id="" cols="100" rows="5">{{$data->note}}</textarea>
										</div>
									</div>
									<!-- <div class="form-group">
								      	<label for="txtAddress">Phương thức thanh toán</label>
								      	<input type="text"  disabled value="<?php 
								      		if($data->payment ==0)  echo "Thanh toán khi giao hàng";  
								      		if($data->payment == 1) echo "Chuyển khoản qua ngân hàng"; 
								      	?>"  class="form-control" />
									</div> -->
									<div class="form-group">
								      	<label for="ten">Tình trạng đơn hàng</label>
								      	<select name="status" class="form-control">
								      		<option value="0" {{ isset($data) && $data->status == 0 ? 'selected=""' : '' }}>Mới đặt</option>
                							<option value="1" {{ isset($data) && $data->status == 1 ? 'selected=""' : '' }}>Xác nhận</option>
                							<option value="2" {{ isset($data) && $data->status == 2 ? 'selected=""' : '' }}>Đang giao hàng</option>
                							<option value="3" {{ isset($data) && $data->status == 3 ? 'selected=""' : '' }}>Hoàn thành</option>
                							<option value="4" {{ isset($data) && $data->status == 4 ? 'selected=""' : '' }}>Hủy</option>
								      	</select>
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
					                <!-- <th style="width: 20px;"><input type="checkbox" name="chonhet" class="minimal" id="chonhet" /></th> -->
					                <th class="text-center with_dieuhuong">Stt</th>
					                <th>Tên sản phẩm</th>
					                <th>Hình ảnh</th>
					                <th>Số lượng</th>
					                <th>Đơn giá</th>
					                <th>Tổng tiền</th>
					              </tr>
					            </thead>
					            <tbody>
					            @foreach($detail as $key=>$dt)  
					              <tr>
					                <!-- <td><input type="checkbox" name="chon" id="chon" value="" class="chon" /></td> -->
					                <td class="text-center with_dieuhuong">{{$key+1}}</td>
					                <td>{{$dt->product_name}}</td>
					                <td><img src="{{asset('upload/product/'.$dt->product_img)}}" width="100px" height="100px" alt=""></td>
					                <td>{{$dt->product_numb}}</td>
									
					                <td>{{ number_format($dt->product_price) }}</td>
					                <td>{{ number_format($dt->product_numb * $dt->product_price) }}</td>
					              </tr>
					           	@endforeach
					            </tbody>
					          </table>
					        </div><!-- /.box-body -->
					        <div class="form-group">
					        
					        	<h4>Tổng thành tiền: <b> {{ number_format($data->total) }} VNĐ</b></h4>
					        </div>
	                    	<div class="clearfix"></div>
	                	</div><!-- /.tab-pane -->
	                </div><!-- /.tab-content -->
	            </div>
			    <div class="clearfix"></div>
			    <div class="box-footer col-md-12 row">
					<div class="col-md-6">
				    	<button type="submit" class="btn btn-primary">Cập nhật</button>
				    	<button type="button" onclick="javascript:window.location='backend/orders'" class="btn btn-danger">Thoát</button>
			    	</div>
			  	</div>
		    </form>
        </div><!-- /.box-body -->
    </div><!-- /box -->
    
</section><!-- /.content -->
@endsection()
