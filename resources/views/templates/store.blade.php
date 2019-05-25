@extends('index')
@section('content')
<section class="vk-content">
    <div class="vk-breadcrumb">
        <nav class="container">
            <ul class="vk-list vk-list--inline vk-breadcrumb__list">
                <li class="vk-list__item"><a href="{{url('')}}"><i class="vk-icon fa fa-home"></i> Trang chủ</a></li>

                <li class="vk-list__item active">Hệ thống của hàng</li>
            </ul>
        </nav>
    </div>
    <!--./vk-breadcrumb-->
    <div class="container">

        <div class="vk-banner vk-banner--style-1">
            <div class="vk-box  vk-box--style-1">
                <h1 class="vk-box__title">
                    Danh sách
                    <span>Cửa hàng</span>
                </h1>
            </div>
        </div> <!--./banner-->

        <div class="vk-shop__list row">
		@foreach($store as $item)
            <div class="col-lg-6 _item">
                <div class="vk-shop-item vk-shop-item--style-1">

                    <a href="#" title="{{$item->name}}" class="vk-img vk-img--cover ">
                        <img src="{{asset('upload/hinhanh/'.$item->photo)}}" alt="{{$item->name}}" class="vk-img__img">
                    </a>

                    <div class="vk-shop-item__brief">
                        <h3 class="vk-shop-item__title"><a href="#" title="{{$item->name}}">{{$item->name}}</a></h3>
                        <div class="vk-shop-item__address"><i class="_icon fa fa-globe"></i> {{$item->address}}</div>
                        <div class="vk-shop-item__phone"><i class="_icon fa fa-phone"></i> <a href="callto:{{$item->phone}}">{{$item->phone}}</a></div>
                        <a href="{{$item->map}}" target="_blank" class="vk-btn vk-btn--link">Xem đường đi</a>
                    </div>
                </div> <!--./vk-shop-item-->
            </div>
		@endforeach
            

        </div> <!--./list-->

    </div> <!--./container-->


    <div class="vk-map">
        <div class="vk-map__img">
            <img src="{{ asset('public/images/map.jpg')}}" alt="">
        </div>

        <div class="vk-map__main">
            <div class="container">
                <div class="vk-map__wrapper">
                    <div class="vk-map__content">
                        <h2 class="vk-map__title">HỆ THỐNG CỦA HÀNG VIDCOM</h2>
                        <div class="vk-map__text">
                            Vidcom hiện đang sở hữu hệ thống 16 Siêu thị Nội Thất và Trang Trí tại hai thành phố chính của
                            Việt Nam là Hà Nội và TP.Hồ Chí Minh.
                        </div>
                        <a href="{{url('cua-hang')}}" class="vk-btn vk-btn--white vk-map__btn">Xem hệ thống cửa hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!--./map-->

</section>
@endsection