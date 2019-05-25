@extends('index')
@section('content')
<?php
    $setting = Cache::get('setting');
?>
<div class="box-home">
    <div class="container">
        <h1 class="title_home">{{$data->name}}</h1>
        <div class="dongke"><span></span></div>
        <div class="box-about">
            {!! $data->content !!}
        </div>
    </div>
</div>
@endsection

