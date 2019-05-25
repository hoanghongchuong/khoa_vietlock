@extends('index')
@section('content')
<?php
    $setting = Cache::get('setting');
    
?>
<div class="crumb">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('')}}">Trang chủ</a>
                </li>
                <li><a href="{{url('san-pham')}}">Sản phẩm</a></li>
                <li class="active">{{$product_detail->name}}</li>
            </ol>
        </div>
    </div>
</div>
<div class="box-product-detail">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="box-img-product">
                    <img src="{{asset('upload/product/'.$product_detail->photo)}}" alt="{{$product_detail->name}}">
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="name_product_detail">{{$product_detail->name}}</h1>
                <p class="price_detail">Giá: {{number_format($product_detail->price)}} VNĐ</p>
                <div class="des-product">
                    {!! $product_detail->mota !!}
                </div>
                <div class="box-order">
                    <button class="btn btn-big button btn-dathang" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-paper-plane-o" aria-hidden="true"></i> ĐẶT HÀNG        
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="des_detail_product">
                <div class="col-md-12">
                    <h3 class="title-detail">Chi tiết</h3>
                    <div class="detail">
                        {!! $product_detail->content !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 30px; margin-bottom: 30px;">
        <h3>Sản phẩm liên quan</h3>
        <div class="owl-carousel owl-carousel-slider owl-carousel-product detail_item_product owl-theme">
            @foreach($productSameCate as $post)
            <div class="item">
                <a href="{{url('san-pham/'.$post->alias.'.html')}}" title="">
                    <img src="{{asset('upload/product/'.$post->photo)}}" alt="">
                </a>
                
                <div class="footer-cate">
                    <p class="name_product"><a href="{{url('san-pham/'.$post->alias.'.html')}}" title="">{{$post->name}}</a></p>
                    <div class="price tac">
                        @if($post->price_old > $post->price)
                        <span class="price_old">{{number_format($post->price_old)}} vnđ</span>
                        @endif
                        <span class="price_news">{{number_format($post->price)}} vnđ</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">    
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Đặt mua nhanh</h4>
              <p style="text-align: center;">Vui lòng điền đầy đủ thông tin của Quý khách sau đó Click vào ĐẶT HÀNG</p>
            </div>
            <div class="modal-body">
                <div class="col-md-6 col-xs-12">
                    <div class="box-product-info">
                      <img src="{{asset('upload/product/'.$product_detail->photo)}}" alt="">
                      <p style="margin-top: 10px;">{{$product_detail->name}}</p>
                      <p class="price">Liên hệ</p>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <form action="{{ route('postContact') }}" method="post" accept-charset="utf-8">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="">Họ tên <span style="color: red">*</span></label>                        
                            <input type="text" name="name" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Số điện thoại <span style="color: red">*</span></label>
                            <input type="text" name="phone" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Sản phẩm cần mua<span style="color: red">*</span></label>
                            <input type="text" name="product" class="form-control" required="">
                        </div>
                        <div class="form-group">
                            <label for="">Ghi chú</label>                        
                            <textarea name="content" class="form-control"></textarea>
                        </div>
                        <div class="form-group"><button type="submit" class="form-control btn-order">Đặt hàng</button></div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            </div>
        </div>
      
    </div>
</div>

@endsection
