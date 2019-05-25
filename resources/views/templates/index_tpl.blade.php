@extends('index')
@section('content')
<?php
$setting = Cache::get('setting');
$sliders = DB::table('slider')->where('status',1)->where('com','gioi-thieu')->orderBy('id','desc')->get();
?>
<div class="box-content">
    <div class="container">
        <div class="row">
            <div class="col-md-3 pdr-0 hidden-xs">
                <div class="list-category-home">
                    <ul>
                        @foreach($categories_home as $category)
                        <li><a href="{{url('san-pham/'.$category->alias)}}">{{$category->name}}</a></li>
                        @endforeach                        
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-xs-12 pdl-0 pdr-0">
                <div id="carousel-id1" class="carousel slide" data-ride="carousel">                    
                    <div class="carousel-inner">
                        @foreach($sliders as $k=>$slider)
                        <div class="item @if($k==0) active @endif">
                            <img  alt="Third slide" src="{{asset('upload/hinhanh/'.$slider->photo)}}">
                            
                        </div>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#carousel-id1" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                    <a class="right carousel-control" href="#carousel-id1" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
            </div>
            <div class="col-md-3 pdl-0 hidden-xs">
                <div class="list-news-home">
                    <div class="title--news-home">Tin mới</div>
                    <ul>
                        @foreach($news as $n)
                        <li><i class=" fa fa-caret-right"></i><a href="{{url('tin-tuc/'.$n->alias.'.html')}}">{{ $n->name }}</a></li>
                        @endforeach                       
                    </ul>
                </div>
            </div>
        </div>
    </div>  
</div>
<div class="box-content">
    <div class="container">
        <div class="row">
            <div class="col-md-9">                  
                <div class="top-box">
                    <div class="pull-left">                        
                        <span class="section-title-main cate-name"><i class="fa fa-star"></i> Những dòng sản phẩm khóa được ưa chuộng nhất</span>
                    </div>
                    <div class="pull-right mt-10">
                        <span class=""><a href="" class="read-more">Xem tất cả <i class="fa fa-angle-right"></i></a></span>
                    </div>
                </div>
                <div class="list-product-item">
                    <div class="owl-carousel owl-theme owl-carousel-product owl-carousel-product1">
                        @foreach($productHot as $product)
                        <div class="item">
                            <a href="{{url('san-pham/'.$product->alias.'.html')}}" title="{{$product->name}}"><img src="{{asset('upload/product/'.$product->photo)}}" alt="{{$product->name}}">
                            </a>
                            <div class="footer-cate">
                                <p class="name_product tac"><a href="{{url('san-pham/'.$product->alias.'.html')}}" title="{{$product->name}}">{{$product->name}}</a></p>
                                <div class="price">
                                    @if($product->price > 0)
                                        @if($product->price < $product->price_old)
                                        <span class="price_old">{{number_format($product->price_old)}} đ </span>
                                        @endif
                                        <span class="price_new">{{number_format($product->price)}} đ </span>
                                    @else
                                        <span class="price_new">Liên hệ </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- end box -->
                @foreach($categories_hot as $cate_hot)
                <div class="top-box">
                    <div class="pull-left">                        
                        <span class="section-title-main cate-name"><i class="fa fa-lock"></i> {{$cate_hot->name}}</span>
                    </div>
                    <div class="pull-right mt-10">
                        <span class=""><a href="{{url('san-pham/'.$cate_hot->photo)}}" class="read-more">Xem tất cả <i class="fa fa-angle-right"></i></a></span>
                    </div>
                </div>
                <div class="list-product-item">
                    @foreach($cate_hot->products as $item)                    
                    <div class="item col-md-4 col-xs-4">
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
                <!-- end box -->
                @endforeach
            </div>
            <div class="col-md-3">
                <div class="support">
                    <p><img src="{{asset('public/images/ht.png')}}" alt=""></p>
                    @foreach($feedback as $f)
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="{{ asset('upload/hinhanh/'.$f->photo) }}" alt="Image">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$f->name}}</h4>
                            <p>{{$f->content}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="list-banner">
                    @foreach($banners as $banner)
                    <p><img src="{{asset('upload/hinhanh/'.$banner->photo)}}" alt=""></p>
                    @endforeach
                </div>
                <div class="box-fanpage">
                    <div class="fb-page" data-href="{{$setting->facebook}}" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="{{$setting->facebook}}" class="fb-xfbml-parse-ignore"><a href="{{$setting->facebook}}">Facebook</a></blockquote></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box-content">
    <div class="container">
        <div class="row">
            <h4 class="ncc">Nhà cung cấp hàng đầu</h4>
            <div class="list-ncc">
                <div class="owl-carousel owl-theme owl-carousel-partner">
                    @foreach($partner as $p)
                    <div class="item">
                        <a href="#" title=""><img src="{{asset('upload/banner/'.$p->photo)}}" alt="">
                        </a>                        
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
