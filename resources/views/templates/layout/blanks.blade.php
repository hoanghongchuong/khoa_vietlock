<?php
    $setting = Cache::get('setting');
?>
Thông tin liên hệ từ website {!! $setting->website !!}
<br>
Họ tên: {{ $hoten }} 	
<br>
Địa chỉ: {{ $diachi }}
<br>
Điện thoại: {{ $dienthoai }} 	
<br>
Email: {{ $email }}		
<br>
Tin nhắn: {{ $noidung }}
