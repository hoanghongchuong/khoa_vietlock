@extends('index')
@section('content')
<main class="cd-main-content">
    <section class="banner-page banner-content" style="background: url({{ asset('upload/hinhanh/'.$banner->photo) }}) no-repeat center;">
        <div class="container-fluid">
            <div class="col-md-5 offset-md-7">
                <div class="banner-page-text z-index-2 text-center">
                    <h1>{{ $banner->name }}</h1>
                    <h2>{!!$banner->mota!!}</h2>
                    <p><a href="" title="" class="btn-box btn-invert btn-invert-1 inflex-center-center">Tìm hiểu thêm</a></p>
                </div>
            </div>
        </div>
    </section>
    <section class="index-service index-service-content">
        <div class="container">
            <h2 class="index-title text-center text-uppercase font-ice"><span>TẠI SAO CHỌN CHÚNG TÔI?</span></h2>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <p class="desc">{{$why->mota}}</p>
                </div>
                <div class="col-md-5 offset-md-1 flex-center-end">
                    <div class="service-content-text text-right">
                        {!! $why->content !!}
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="service-content-images">
                        <img src="{{ asset('upload/hinhanh/'.$why->photo)}}" alt="" title="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="work-step-content pd-60">
        <div class="container">
            <h2 class="index-title text-center text-uppercase font-ice"><span>QUY TRÌNH LÀM VIỆC</span></h2>
            <style>
                .load-more-google0.active{
                    max-height: 65px;
                    overflow: hidden;
                }
                .load-more-google1.active{
                    max-height: 65px;
                    overflow: hidden;
                }
                .load-more-google2.active{
                    max-height: 65px;
                    overflow: hidden;
                }
            </style>
            <div class="row">
                @foreach($quytrinh as $k=>$item)
                <div class="col-md-4">
                    <div class="google-step">
                        <h3><img src="{{asset('upload/hinhanh/'.$item->photo)}}" alt="" title=""> </h3>
                        <h4>{{$item->name}}</h4>
                        <p class="load-more-google{{$k}}">{{$item->mota}}</p>
                        <p class="mgt-20"><a href="javascript:;" title="" class="btn-loadmore-google{{$k}}">Xem thêm</a> </p>
                    </div>
                </div>
                @endforeach
            </div>
            <script>
                $this  = $('.load-more-google0');
                var number = $this.height();
                if( number > 60) {
                    $this.closest('.load-more-google0').addClass('active')
                }
                $('.btn-loadmore-google0').click(function (e) {
                    e.preventDefault();
                    $('.load-more-google0').toggleClass('active')
                })
            </script>
            <script>
                $this  = $('.load-more-google1');
                var number = $this.height();
                if( number > 60) {
                    $this.closest('.load-more-google1').addClass('active')
                }
                $('.btn-loadmore-google1').click(function (e) {
                    e.preventDefault();
                    $('.load-more-google1').toggleClass('active')
                })
            </script>
            <script>
                $this  = $('.load-more-google2');
                var number = $this.height();
                if( number > 60) {
                    $this.closest('.load-more-google2').addClass('active')
                }
                $('.btn-loadmore-google2').click(function (e) {
                    e.preventDefault();
                    $('.load-more-google2').toggleClass('active')
                })
            </script>
        </div>
    </section>
    <section class="case-content pd-60">
        <div class="container">
            <h2 class="index-title text-center text-uppercase font-ice"><span>CASE STUDY TIÊU BIỂU</span></h2>
            <div class="desc">{!! $slogan->mota !!}</div>
            <div class="case-slider-3 owl-carousel slider-general">
                @foreach($projects as $project)
                <div class="item">
                    <div class="relative">
                        <img src="{{asset('upload/news/'.$project->photo)}}" alt="" title="">
                        <a href="{{ url('du-an/'.$project->alias.'.html') }}" title="" class="absolute flex-center-center"><i class="fa fa-search"></i> </a>
                    </div>
                    <h4 class="text-center"><a href="{{ url('du-an/'.$project->alias.'.html') }}" title="">{{ $project->name }}</a> </h4>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="partner pd-60 partner-content">
        <div class="container">
            <h2 class="index-title text-uppercase text-center font-ice"><span>ĐỐI TÁC</span></h2>
            <div class="partner-slider owl-carousel">
                @foreach($partners as $p)
                <div class="item">
                    <a href="#"><img src="{{ asset('upload/hinhanh/'.$p->photo) }}" alt="" title=""> </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection