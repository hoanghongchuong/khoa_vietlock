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
                <li class="active">Giỏ hàng</li>
            </ol>
        </div>
    </div>
</div>
<div class="content-home" style="margin-bottom: 30px;">
    <div class="container">
        <div class="">
            <div class="vk-page vk-page--shopcart">
                <div class="vk-shopcart">
                    <form action="{{route('updateCart')}}" method="post" id="cartformpage">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" >    
                        <div class="table-responsive">
                            <h1 class="vk-shopcart__heading">Giỏ hàng</h1>
                            <table class="table">
                                
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Giá bán</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product_cart as $key=>$item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{ number_format($item->price) }} vnđ</td>
                                        <td>
                                            <input type="number" id="{{ $item->rowId }}"  name="numb[{{$key}}]" value="{{$item->qty}}" min="1" class="form-control order-2">
                                        </td>
                                        <td>{{number_format($item->price * $item->qty)}} vnđ</td>
                                        <td><a href="{{url('xoa-gio-hang/'.$item->rowId)}}" title=""><i class="fa fa-trash"></i> Xóa</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="vk-shopcart__button">
                            <div class="pull-left">
                                <a href="{{url('thanh-toan')}}" title="" class="vk-btn btn-update-cart">Thanh toán</a>
                                <button class="vk-btn btn-update-cart">Cập nhật</button>
                                <!-- <a href="#" title="" class="vk-btn vk-btn--outline-grey-6">Xóa giỏ hàng</a> -->
                            </div>
                            <div class="vk-shopcart__total pull-right">
                                Tổng tiền: <span>{{number_format($total)}} vnđ</span>
                            </div>
                        </div>
                    </form>                        
                </div> 

            </div> 
        </div>
    </div>
</div>

@endsection
