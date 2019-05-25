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
                
                <li class="active">Khách hàng dự án</li>
            </ol>
        </div>
    </div>
</div>
<div class="content-home-cate">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-9">
                @foreach($tintuc as $item)
                <div class="box-item-news">
                    <div class="col-xs-12 col-md-3">
                        <a href="{{ url('khach-hang-du-an/'.$item->alias.'.html') }}" title="{{$item->name}}"><img src="{{asset('upload/news/'.$item->photo)}}" alt="{{$item->name}}"></a>
                    </div>
                    <div class="col-xs-12 col-md-9">
                        <a href="{{ url('khach-hang-du-an/'.$item->alias.'.html') }}" title="{{$item->name}}">
                            <p class="name_news">{{$item->name}}</p>                                
                        </a>
                        <div class="des_news">
                            {!! $item->mota !!}
                        </div>
                    </div>
                </div>
                @endforeach                   
            </div>                
        </div>
    </div>
</div>
@endsection