<?php
    $setting = Cache::get('setting');
    $sliders = DB::table('slider')->where('com','gioi-thieu')->where('status',1)->get();
    $categories = \App\ProductCate::where('com','san-pham')->where('parent_id',0)->orderBy('id','desc')->get();
    $cateServices = \App\NewsCate::where('com','dich-vu')->where('parent_id',0)->get();
    // dd($cateServices);
?>
<header id="header" class="">
    <div class="container">
        <div class="row">
            <div class="top_header">
                <div class="col-md-3 col-xs-12 tac">
                    <a href="{{ url('') }}" title=""><img src="{{asset('upload/hinhanh/'.$setting->photo)}}" class="logo-img" alt=""></a>
                </div>
                <div class="col-md-9">
                    <div class="name-company tac">{{$setting->company}}</div>
                    <div class="box-info-header tac">
                        <p class="mb-0"><i class="fa fa-home"></i> {{ $setting->address }}</p>
                        <p><i class=" fa fa-phone"></i> {{$setting->phone}}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- menu-mobile -->                        
    </div>
</header><!-- /header -->
<div class="visible-xs visible-sm menu-mobile">
    <div class="vk-header__search">
        <div class="container">                
            <a href="#menuMobile" class="menu_Mobile" data-toggle="collapse" class="_btn d-lg-none menu_title"><i class="fa fa-bars"></i> Menu</a>
        </div>
    </div>
    <nav class="vk-header__menu-mobile">
        <ul class="vk-menu__mobile collapse" id="menuMobile">
            
            <li><a href="{{url('')}}">Trang chủ</a></li>
            <li>
                <a href="{{url('san-pham')}}">Sản phẩm</a>

                <a href="#menu2" data-toggle="collapse" class="_arrow-mobile"><i class="_icon fa fa-angle-down"></i></a>
                <ul class="collapse" id="menu2">                    
                    @foreach($categories as $cate)
                        <li><a href="{{url('san-pham/'.$cate->alias)}}">{{ $cate->name }}</a></li>
                    @endforeach                    
                </ul>
            </li>
            <li>
                <a href="">Dịch vụ</a>
                <a href="#menu3" data-toggle="collapse" class="_arrow-mobile"><i class="_icon fa fa-angle-down"></i></a>
                <ul class="collapse" id="menu3">
                    @foreach($cateServices as $service)
                    <li><a href="{{url('dich-vu/'.$service->alias)}}">{{$service->name}}</a></li>
                    @endforeach
                                          
                </ul>
            </li>
            <li><a href="{{url('cong-trinh')}}">Công trình</a></li>                                       
            <li><a href="{{url('tin-tuc')}}">Tin tức</a></li>                            
            <li><a href="{{url('lien-he')}}">Liên hệ</a></li>
        </ul>
    </nav>        
</div>    
<div class="menu-cate visible-md visible-lg">        
    <div class="menu">
        <div class="container">
            <div class="row">
                <div class="col-md-3 pdr-0 fix-menu-cate">
                    <ul class="category">
                        <li><a href="javascript:;" class="fix-click" title="">Danh mục sản phẩm <i class="fa fa-bars"></i></a></li>
                    </ul>
                    <div class="list-category-home fix-box-menu-cate">
                        <ul>
                            @foreach($categories as $category)
                            <li><a href="{{url('san-pham/'.$category->alias)}}">{{$category->name}}</a></li>
                            @endforeach                        
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 pdl-0">
                    <ul class="navi">                                       
                        <li><a href="{{url('')}}">Trang chủ</a></li>
                        <li><a href="{{url('san-pham')}}">Sản phẩm</a></li>
                        <li>
                            <a href="{{url('dich-vu')}}">Dịch vụ <i class="fa fa-angle-down"></i></a>
                            <ul class="vk-menu__child">                                
                                @foreach($cateServices as $service)
                                <li><a href="{{url('dich-vu/'.$service->alias)}}">{{$service->name}}</a></li>
                                @endforeach                        
                            </ul>
                        </li>
                        <li><a href="{{url('cong-trinh')}}">Công trình</a></li>                                       
                        <li><a href="{{url('tin-tuc')}}">Tin tức</a></li>                            
                        <li><a href="{{url('lien-he')}}">Liên hệ</a></li>
                    </ul>
                </div>                 
            </div>
        </div>
    </div>
</div>