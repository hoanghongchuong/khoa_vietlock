<?php
    $setting = Cache::get('setting');
    $posts = DB::table('news')->where('com','bai-viet')->where('status',1)->get();
?>
<footer>
      <div class="container">
          <div class="row">               
              <p><a href="" title=""><img src="{{asset('upload/hinhanh/'.$setting->photo_footer)}}" class="logo-img" alt=""></a></p>
              <div class="col-md-6">
                <p class="name_f">{{$setting->company}}</p>
                <p class="">Địa chỉ: {{$setting->address}}</p>
                <p>Hotline: <span style="color: red;">{{$setting->hotline}}</span></p>
                <p>Email: <span style="color: red">{{$setting->email}}</span></p>
                <p class="social">
                  <a href="{{$setting->facebook}}" title=""><i class="fa fa-facebook"></i></a>
                  <a href="{{$setting->youtube}}" title=""><i class="fa fa-youtube"></i></a>
                  <a href="{{$setting->google}}" title=""><i class="fa fa-google"></i></a>
                  <a href="{{$setting->twitter}}" title=""><i class="fa fa-twitter"></i></a>
                </p>
              </div>
              <div class="col-md-6">
                <div class="box-map-footer">
                  {!! $setting->iframemap !!}
                </div>
              </div>             
          </div>            
      </div>
  </footer>
  <div class="bottom-footer">
    <p>Thiết kế bởi hungthinhads.vn</p>
  </div>
<div class="phonering-alo-phone phonering-alo-green phonering-alo-show" id="phonering-alo-phoneIcon" style="left: -50px; bottom: 0; display: block;position: fixed; z-index: 99999999999999999999999">
  <div class="phonering-alo-ph-circle"></div>
    <div class="phonering-alo-ph-circle-fill"></div>
      <a href="tel{{$setting->phone}}:"></a>
       <div class="phonering-alo-ph-img-circle">
        <a href="tel:{{$setting->phone}}"></a>
        <a href="tel:{{$setting->phone}}" class="pps-btn-img " title="{{$setting->phone}}">
            <img src="https://i.imgur.com/v8TniL3.png" alt="" width="50" onmouseover="this.src = 'https://i.imgur.com/v8TniL3.png';" onmouseout="this.src = 'https://i.imgur.com/v8TniL3.png';">
        </a>
  </div>        
</div>