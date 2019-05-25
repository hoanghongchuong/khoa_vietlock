<?php
    $setting = DB::table('setting')->select()->where('id',1)->get()->first();
?>
Thư gửi từ website {!! $setting->website !!}
<h3> {!! $title !!} </h3>	
<br>
Nội dung: {!! $content !!}