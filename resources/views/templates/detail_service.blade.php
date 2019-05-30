@extends('index')
@section('content')
<div class="crumb">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb breadcrumbx">
                <li><a href="{{url('')}}">Trang chủ</a></li>                
                <li class="{{url('dich-vu')}}">Dịch vụ</li>
                <li class="active">{{$data->name}}</li>
            </ol>
        </div>
    </div>
</div>
<div class="content-home-cate mt-0">
    <div class="container">
        <div class="row">            
            <div class="col-xs-12 col-md-9">
                <div class="name_detail">{{$data->name}}</div>
                <div class="content_detail">
                    {!! $data->content !!}
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
        
    </div>
</div>
@endsection

