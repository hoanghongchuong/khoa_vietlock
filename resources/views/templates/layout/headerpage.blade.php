<?php
    $setting = Cache::get('setting');
?>
<header class="header-page">
    <section class="header-section visible-desktop">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-33">
                    <a href="{{url('')}}" title="" class="logo"><img src="{{asset('upload/hinhanh/'.$setting->photo_page)}}" alt="" title=""> </a>
                </div>
                <div class="col-md-6 col-99">
                    <div class="header-nav">
                        <ul class="flex-center-between">
                            <li ><a href="{{url('')}}" title="">Trang chủ</a> </li>
                            <li @if(@$com == 'gioi-thieu') class="active" @endif><a href="{{url('gioi-thieu')}}" title="">Giới thiệu</a> </li>
                            <li @if(@$com == 'dich-vu') class="active" @endif>
                                <a href="#" title="">Dịch Vụ</a>
                                <ul class="submenu">
                                    <li><a href="{{url('dich-vu-marketing')}}" title="">Facebook ads</a> </li>
                                    <li><a href="{{url('dich-vu-google-adword')}}" title="">Google adword</a> </li>
                                    <li><a href="{{url('dich-vu-seo')}}" title="">Seo</a> </li>
                                    <li><a href="{{url('dich-vu-content')}}" title="">Content</a> </li>
                                </ul>
                            </li>
                            <li @if(@$com == 'du-an') class="active" @endif><a href="{{url('du-an')}}" title="">Dự Án</a></li>
                            <li @if(@$com == 'tin-tuc') class="active" @endif><a href="#" title="">Tin tức</a> 
                                <ul class="submenu">
                                    <li><a href="{{url('tin-tuc')}}" title="">Tin tức</a> </li>
                                    <li><a href="{{url('tuyen-dung')}}" title="">Tuyển dụng</a> </li>
                                </ul>
                            </li>
                            <li @if(@$com == 'lien-he') class="active" @endif><a href="{{url('lien-he')}}" title="">Liên hệ</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="header-mobile visible-mobile">
        <div class="container">
            <div class="logo flex-center-between">
                <a href="{{url('')}}" title=""><img src="{{asset('upload/hinhanh/'.$setting->photo_page)}}" alt="" title=""> </a>
                <div class="mobile-action">
                    <a href="javascript:;" data-toggle="modal" data-target="#register-form"  title="Đăng ký tư vấn" class="register-icon"><i class="fa fa-pencil-square-o"></i></a>
                    <a id="cd-menu-trigger" href="#0" class=""><span class="cd-menu-icon"></span></a>
                </div>
            </div>
        </div>
    </section>
</header>