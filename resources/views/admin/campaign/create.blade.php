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
          
          <form name="frmAdd" method="post" action="{!! route('campaignCreate', ['id' => isset($campaign) ? $campaign->id : '' ]) !!}">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                          
            <div class="clearfix"></div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Tên</label>
                <input type="text" name="campaign_name" class="form-control" value="{{ isset($campaign) ? $campaign->campaign_name : '' }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Loại</label>
                <select type="text" name="campaign_type" class="form-control">
                	<option>---Chọn loại---</option>
                	<option value="1" {{ isset($campaign) && $campaign->campaign_type == 1 ? 'selected=""' : '' }}>Trừ tiền</option>
                	<option value="2" {{ isset($campaign) && $campaign->campaign_type == 2 ? 'selected=""' : '' }}>Trừ %</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Giá  trị</label>
                <input type="text" name="campaign_value" class="form-control" value="{{ isset($campaign) ? $campaign->campaign_value : '' }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Số lượng thẻ</label>
                <input type="number" name="card_numb" class="form-control" value="{{ isset($campaign) ? $campaign->card_numb : 1 }}" min="{{ isset($campaign) ? $campaign->card_numb : 1 }}">
                <input type="hidden" name="card_numb_old" value="{{ isset($campaign) ? $campaign->card_numb : 1 }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Ngày hết hạn</label>
                <input type="date" name="campaign_expired" class="form-control" value="{{ isset($campaign) ? $campaign->campaign_expired : '' }}">
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
