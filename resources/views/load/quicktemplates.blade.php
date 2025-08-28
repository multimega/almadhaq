@php
    $slang = Session::get('language');
    $lang  = DB::table('languages')->where('is_default','=',1)->first();

@endphp
<style>
    .add-cart,
    .add-to-wish {
        font-size: 16px;
        color: #fff;
        display: inline-block;
        border: 1px solid #b08c50;
        background: #b08c50;
        color: #fff;
        padding: 12px 28px;
        font-weight: 600;
        border-radius: 0;
        -webkit-transition: all .3s ease-in;
        -o-transition: all .3s ease-in;
        transition: all .3s ease-in;
    }
</style>
<div class="product-single-container product-single-default product-quick-view container">
    <div class="row">
        <div class="col-lg-6 col-md-6 product-single-gallery">
            <div class="product-slider-container product-item">
                <div class="product-single-carousel owl-carousel owl-theme">
                    <div class="product-item">
                        <img class="product-single-image"
                             src="{{filter_var($product->photo, FILTER_VALIDATE_URL) ?$product->photo:asset('assets/images/products/'.$product->photo)}}"
                             data-zoom-image="{{filter_var($product->photo, FILTER_VALIDATE_URL) ?$product->photo:asset('assets/images/products/'.$product->photo)}}"

                             @if(!$slang)
                             @if($lang->id == 2)

                             alt="{{$product->alt_ar}}"
                             @else
                             alt="{{$product->alt}}"
                             @endif
                             @else
                             @if($slang == 2)
                             alt="{{$product->alt_ar}}"
                             @else
                             alt="{{$product->alt}}"
                            @endif
                            @endif
                        />
                    </div>

                    @foreach($product->galleries as $gal)
                        <div class="product-item">
                            <img class="product-single-image" src="{{asset('assets/images/galleries/'.$gal->photo)}}"
                                 data-zoom-image="{{asset('assets/images/galleries/'.$gal->photo)}}"
                                 @if(!$slang)
                                 @if($lang->id == 2)

                                 alt="{{$product->alt_ar}}"
                                 @else
                                 alt="{{$product->alt}}"
                                 @endif
                                 @else
                                 @if($slang == 2)
                                 alt="{{$product->alt_ar}}"
                                 @else
                                 alt="{{$product->alt}}"
                                @endif
                                @endif

                            />
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>
                <div class="col-3 owl-dot">
                    <img
                        src="{{filter_var($product->photo, FILTER_VALIDATE_URL) ?$product->photo:asset('assets/images/products/'.$product->photo)}}"
                        style="height:100px;"
                        @if(!$slang)
                        @if($lang->id == 2)

                        alt="{{$product->alt_ar}}"
                        @else
                        alt="{{$product->alt}}"
                        @endif
                        @else
                        @if($slang == 2)
                        alt="{{$product->alt_ar}}"
                        @else
                        alt="{{$product->alt}}"
                        @endif
                        @endif

                    />
                </div>
                @foreach($product->galleries as $gal)
                    <div class="col-3 owl-dot">
                        <img src="{{asset('assets/images/galleries/'.$gal->photo)}}" style="height:100px;"/>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="product-single-details">
                <h1 class="product-title">

                    @if(!$slang)
                        @if($lang->id == 2)

                            {{ $product->name_ar }}

                        @else

                            {{ $product->name }}

                        @endif
                    @else
                        @if($slang == 2)

                            {{ $product->name_ar }}

                        @else
                            {{ $product->name }}

                        @endif
                    @endif

                </h1>

                <br>
                {{--
                <div class="ratings-container">
                    <div class="product-ratings">
                        <span class="ratings" style="{{App\Models\Rating::ratings($product->id)}}%"></span><!-- End .ratings -->
                    </div><!-- End .product-ratings -->

                </div><!-- End .product-container -->
                --}}
                <div class="price-box">
                    <span class="old-price">{{ $product->showPreviousPrice() }}</span>
                    <span class="product-price">{{ $product->showPrice() }}</span>
                </div><!-- End .price-box -->

                <div class="product-desc">

                    <p> @if(!$slang)
                            @if($lang->id == 2)

                                {!! substr($product->details_ar,0,376) !!}

                            @else

                                {!! substr($product->details,0,376) !!}

                            @endif
                        @else
                            @if($slang == 2)

                                {!! substr($product->details_ar,0,376) !!}

                            @else
                                {!! substr($product->details,0,376) !!}

                            @endif
                        @endif    </p>

                </div><!-- End .product-desc -->
                @if(!empty($product->color))
                    <div class="product-filters-container">
                        <div class="product-single-filter">

                            <ul class="config-swatch-list">
                                @php
                                    $is_first = true;
                                @endphp
                                @foreach($product->color as $key => $data1)
                                    <li class="{{ $is_first ? 'active' : '' }}">

                                        <span class="box" data-color="{{ $product->color[$key] }}"
                                              style="background-color: {{ $product->color[$key] }}"></span>

                                    </li>
                                    @php
                                        $is_first = false;
                                    @endphp
                                @endforeach

                            </ul>
                        </div><!-- End .product-single-filter -->
                    </div><!-- End .product-filters-container -->
                @endif
                <div class="product-action">

                    <div class="product-single-qty">
                        <input class="horizontal-quantity form-control" type="text">
                    </div>
                    <div>
                        <a href="{{ route('product.cart.quickadd',['id' => $product->id , 'lang' => $sign ]) }}"
                           class="paction add-cart" title="{{$langg->lang56}}">
                            <span>{{$langg->lang56}}</span>
                        </a>
                        @if(Auth::guard('web')->check())

                            <a href="javascript:;" data-href="{{ route('user-wishlist-add',$product->id) }}"
                               class="paction add-wishlist add-to-wish" title="{{$langg->lang54}}">
                                <span>{{$langg->lang54}}</span>
                            </a>
                        @endif
                    </div>
                </div><!-- End .product-action -->
                <div class="product-single-share">
                    <label>{{$langg->lang91}}:</label>
                    <!-- www.addthis.com share plugin-->
                    <div class="addthis_inline_share_toolbox"></div>
                </div><!-- End .product single-share -->
            </div><!-- End .product-single-details -->
        </div><!-- End .col-lg-5 -->
    </div><!-- End .row -->
</div><!-- End .product-single-container -->



