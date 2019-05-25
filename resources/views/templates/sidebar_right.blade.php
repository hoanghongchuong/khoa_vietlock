<?php
    $category_products = DB::table('product_categories')->where('com','san-pham-mau')->orderBy('id','desc')->get();
    $categories = DB::table('product_categories')->where('com','san-pham')->orderBy('id','desc')->get();
    $hot_news = DB::table('news')->where('com','tin-tuc')->where('status',1)->where('noibat','1')->orderBy('id','desc')->take(10)->get();
?>
<div class="col-md-3 col-xs-12">
    <div class="list_category_product">
        <p class="title_cate">
            Dự án đã thực hiện
        </p>
        <ul class="">
            @foreach($categories as $cate)
            <li><a href="{{url('da-thi-cong/'.$cate->alias)}}">{{$cate->name}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="list_category_product">
        <p class="title_cate">
            Sản phẩm mẫu
        </p>
        <ul class="">
            @foreach($category_products as $cate)
            <li><a href="{{url('san-pham-mau/'.$cate->alias)}}">{{$cate->name}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="list_category_product">
        <p class="title_cate">
            Tin nổi bật
        </p>
        <ul class="">
            @foreach($hot_news as $hot)
            <li><a href="{{url('tin-tuc/'.$hot->alias.'.html')}}">{{$hot->name}}</a></li>
            @endforeach
        </ul>
    </div>
</div>