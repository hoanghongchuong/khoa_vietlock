@extends('index')
@section('content')

<div class="content-home-cate">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                <div class="crumb">
                    <a href="{{url('')}}">Trang chủ | </a><a href=javascript:;>Bảng giá | </a> <a href="" title="{{$news_detail->name}}">{{$news_detail->name}}</a>
                </div>
                <div class="name_detail">{{$news_detail->name}}</div>
                
            </div>
            <div class="col-xs-12 col-md-9">
                <div class="content_detail">
                    {!! $news_detail->content !!}
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 30px;">
        <h3>Bài viết liên quan</h3>
        <div class="owl-carousel owl-carousel-slider owl-carousel-product owl-theme">
            @foreach($newsSameCate as $post)
            <div class="item">
                <a href="{{url('bang-gia/'.$post->alias.'.html')}}" title="{{$post->name}}">
                    <img src="{{asset('upload/news/'.$post->photo)}}" alt="{{$post->name}}">
                    <p class="name">{{$post->name}}</p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    </div>
</div>
@endsection

