@extends('index')
@section('content')
<div class="crumb">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb breadcrumbx">
                <li>
                    <a href="{{url('')}}">Trang chủ</a>
                </li>
                <li class="active"><a href="{{url('san-pham')}}">Sản phẩm</a></li>
            </ol>
        </div>
    </div>
</div>
<div class="content-home-cate box-contact-home">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h3 class="title-category">Danh mục sản phẩm</h3>
                <div class="list-category-home sidebar-fix">
                    <ul>
                        @foreach($cate_pro as $cate)
                        <li><a href="{{url('san-pham/'.$cate->alias)}}">{{$cate->name}}</a></li>
                        @endforeach
                        
                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-xs-12">
                <div class="list-product-item cate-box">                     
                    @foreach($products as $item)
                    <div class="item col-md-3 col-xs-4">
                        <a href="{{url('san-pham/'.$item->alias.'.html')}}" title="{{$item->name}}"><img src="{{asset('upload/product/'.$item->photo)}}" alt="{{$item->name}}">
                        </a>
                        <div class="footer-cate">
                            <p class="name_product tac"><a href="{{url('san-pham/'.$item->alias.'.html')}}" title="{{$item->name}}">{{$item->name}}</a></p>
                            <div class="price">
                                @if($item->price > 0)
                                    @if($item->price < $item->price_old)
                                    <span class="price_old">{{number_format($item->price_old)}} đ </span>
                                    @endif
                                    <span class="price_new">{{number_format($item->price)}} đ </span>
                                @else
                                    <span class="price_new">Liên hệ </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
