@extends('index')
@section('content')
<div class="crumb">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb breadcrumbx">
                <li><a href="{{url('')}}">Trang chủ</a></li>                
                <li class="{{url('tin-tuc')}}">Tin tức</li>
                <li class="active">{{$news_detail->name}}</li>
            </ol>
        </div>
    </div>
</div>
<div class="content-home-cate mt-0">
    <div class="container">
        <div class="row">            
            <div class="col-xs-12 col-md-9">
                <div class="name_detail">{{$news_detail->name}}</div>
                <div class="content_detail">
                    {!! $news_detail->content !!}
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <h3 class="news_hot">Tin nổi bật</h3>
                <div class="list-hot-news">
                    @foreach($hot_news as $hot)
                    <p><a href="{{ url('tin-tuc/'.$hot->alias.'.html') }}" title="{{$hot->name}}">{{$hot->name}}</a></p>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- <div class="row" style="margin-top: 30px;">
            <h3>Bài viết liên quan</h3>
            <div class="owl-carousel owl-carousel-slider owl-carousel-product owl-theme">
                @foreach($newsSameCate as $post)
                <div class="item">
                    <a href="{{url('tin-tuc/'.$post->alias.'.html')}}" title="{{$post->name}}">
                        <img src="{{asset('upload/news/'.$post->photo)}}" alt="{{$post->name}}">
                        <p class="name">{{$post->name}}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div> -->
    </div>
</div>
@endsection

