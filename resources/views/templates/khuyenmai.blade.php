@extends('index')
@section('content')
<div class="crumb">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb breadcrumbx">
                <li>
                    <a href="{{url('')}}">Trang chủ</a>
                </li>
                <li><a href="#">Sản phẩm</a></li>
                <li class="active">Khuyến mại</li>
            </ol>
        </div>
    </div>
</div>

<div class="content-home-cate box-contact-home">
    <div class="container">
        <div class="row">
            <div class="list-product-item">
                
                <div class="col-md-12 pdr-0">
                    @foreach($data as $item)
                    <div class="col-md-3 col-xs-6 item">
                        <a href="{{url('san-pham/'.$item->alias.'.html')}}" title="{{$item->name}}"><img src="{{asset('upload/product/'.$item->photo)}}" alt="{{$item->name}}" ></a>
                        @if($item->price_old > $item->price)
                        <div class="sale-of"><span>-{{ round((100 -($item->price/ $item->price_old)*100)) }}%</span></div>
                        @endif
                        <p class="price"> {{number_format($item->price)}} vnd</p>
                        @if($item->price_old > $item->price)
                        <p class="price_old pull-left"> {{number_format($item->price_old)}} vnd</p>
                        @endif
                        <p class="product_name"><a href="{{url('san-pham/'.$item->alias.'.html')}}" title="">{{$item->name}}</a></p>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
