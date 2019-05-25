<script type="text/javascript" src="{{ asset('public/js/fotorama.js') }}"></script>
<div class="row">

    <div class="col-md-4">

        <div class="fotorama" data-nav="thumbs" data-autoplay="2000">

            <img src="{!! asset('upload/product/'.$product_detail->photo) !!}" alt="{!! $product_detail->name !!}" title="">
            @foreach($album_hinh as $item)
            <img src="{!! asset('upload/hasp/'.$item->photo) !!}" alt="{!! $product_detail->name !!}" title="">
            @endforeach

        </div>

    </div>

    <div class="col-md-8">

        <div class="product-detail">

            <h1>{!! $product_detail->name !!}</h1>

            <p class="code">

                @if(!empty($product_detail->code)) <span># {!! $product_detail->code !!}</span> @endif

                <img src="public/images/star.png" alt="" title="">

            </p>

            {!! $product_detail->content !!}

            <p class="price">

                Giá: @if($product_detail->price) {!! number_format($product_detail->price,0,",",".").'VNĐ' !!} @else Liên hệ @endif

            </p>

        </div>

    </div>

</div>

