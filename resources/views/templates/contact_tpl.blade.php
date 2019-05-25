@extends('index')
@section('content')
<?php
    $setting = Cache::get('setting');
    $banner = DB::table('banner_content')->where('position', 5)->first();
?>
<div class="crumb">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb breadcrumbx">
                <li>
                    <a href="{{url('')}}">Trang chủ</a>
                </li>
                
                <li class="active">Liên hệ</li>
            </ol>
        </div>
    </div>
</div>
<div class="content-box content-box-page">
    <div class="content-box-contact" style="margin-bottom: 30px;">
        <div class="container">
            <div class="row info-companyx">
                <div class="col-sm-4">
                    <h1 class="title-contact">Liên Hệ</h1>
                    
                    <p><span class="fwb">Địa chỉ:</span> {{$setting->address}}</p>
                    <p><span class="fwb">Số điện thoại:</span> {{$setting->phone}} - {{$setting->hotline}}</p>
                    <p><span class="fwb">Email:</span> {{$setting->email}}</p>
                </div>
                <div class="col-sm-8">
                    <h2 class="title-send">Gửi tin nhắn</h2>
                    <form action="{{route('postContact')}}" method="post" accept-charset="utf-8" class="contact-frm">
                    	{{csrf_field()}}
                        <div class="row">                                
                                <div class="col-md-6" style="margin-bottom: 10px;">
                                    <label for="">Họ tên</label>                                       
                                    <input type="text" name="name" value="" required="" class="form-control" placeholder="">                                    
                                </div>
                                <div class="col-md-6" style="margin-bottom: 10px;">
                                    <label for="">Địa chỉ</label>
                                    <input type="text" name="address" value="" required="" class="form-control" placeholder="">                                        
                                </div>
                                <div class="col-md-6" style="margin-bottom: 10px;">
                                    <label for="">Số điện thoại</label>
                                    <input type="text" name="phone" value="" required="" class="form-control" placeholder="">
                                    
                                </div>
                                <div class="col-md-6" style="margin-bottom: 10px;">
                                    <label for="">Email</label>
                                    <input type="text" name="email" value="" class="form-control" placeholder="">
                                    
                                </div>
                                <div class="col-md-12" style="margin-bottom: 10px;">
                                    <label for="">Nội dung</label>
                                    <textarea name="content" rows="5" required="" class="form-control" placeholder="Nội dung"></textarea>
                                </div>
                                <div class="text-md-right btn-gui col-md-12" style="margin-top: 10px;">
                                    <button type="submit" class="btn bold more-btn btn-primary">GỬI</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- <div class="map-box">
            <div class="container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d232.8382755930447!2d105.83615366451174!3d20.976099315488543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac5a3a4a0d25%3A0x647fe16b8480d2e2!2zMTQgUC4gTmd1eeG7hW4gQ-G6o25oIEThu4ssIMSQ4bqhaSBLaW0sIFRoYW5oIFh1w6JuLCBIw6AgTuG7mWksIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1540785721770" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div> -->
    </div>
</div>
@endsection
