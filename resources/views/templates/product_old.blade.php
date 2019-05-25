@extends('index')
@section('content')
<?php
    $setting = Cache::get('setting');
    $about = Cache::get('about');
?>
<div class="content-box content-box-page">
    <nav aria-label="breadcrumb" class="nav-breadcrumb">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sản phẩm đã thi công</li>
                </ol>
            </div>
        </div>
    </nav>
    <div class="list-category">
        <div class="container">
            <div class="row">
                <div class="col-md-9">                    
                    <div class="list-item">
                        @foreach($products as $item)
                        <div class="col-md-4 _item">
                            <div class="box-item_cate">
                                <a href="{{url('da-thi-cong/'.$item->alias.'.html')}}" title="{{$item->name}}" class="zoom"><img src="{{asset('upload/product/'.$item->photo)}}"></a>
                                <div class="name_cate"><a href="{{url('da-thi-cong/'.$item->alias.'.html')}}" title="{{$item->name}}">{{$item->name}}</a></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @include('templates.sidebar_right');
            </div>
        </div>
    </div>
</div>

@endsection
