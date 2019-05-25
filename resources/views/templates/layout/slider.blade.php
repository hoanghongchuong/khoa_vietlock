<?php
	$slider = DB::table('slider')->select()->where('status',1)->where('com','gioi-thieu')->orderBy('created_at','desc')->get();

?>
@if(isset($slider))
<div class="slider-area home1">
    <div class="bend niceties preview-2">
        <div id="ensign-nivoslider" class="slides">
        	@foreach($slider as $key=>$item)
            <img src="{{asset('public/img/slider/slider-bg.jpg')}}" alt="" title="#slider-direction-{{$key}}"  />
            @endforeach            
        </div>
        <!-- direction 1 -->
        
	        @foreach($slider as $key=>$item)
	        <div id="slider-direction-{{$key}}" class="t-cn slider-direction">
	            <div class="slider-progress"></div>
	            <div class="slider-content t-cn s-tb slider-1">
	                <div class="title-container s-tb-c">
	                    <h1 class="title1">{{$item->name}}</h1>
	                    <!-- <h1 class="title2"><strong>CHO TẤT CẢ VÁY</strong></h1> -->
	                    <a href="{{$item->link}}"><span>SHOP NOW</span></a>
	                </div>
	            </div>
	            <div class="layer-1 slide1">
	                <img src="{{asset('upload/hinhanh/'.$item->photo)}}" alt="" />
	            </div>	
	        </div>
	        @endforeach
       
    </div>
</div>
	
 @endif