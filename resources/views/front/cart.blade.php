@extends('layouts.front')
@section('content')
@php

$slang = Session::get('language');
$lang = DB::table('languages')->where('is_default','=',1)->first();

if (Session::has('currency')) {

$curr = App\Models\Currency::find(Session::get('currency'));

}else {

$curr = App\Models\Currency::where('is_default','=',1)->first();
}

@endphp

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="pages">
          <li>
            <a href="{{ route('front.index',$sign) }}">
              {{ $langg->lang17 }}
            </a>
          </li>
          <li>
            <a href="{{ route('front.cart',$sign) }}">
              {{ $langg->lang121 }}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Area End -->

<!-- Cart Area Start -->
<section class="cartpage cart-page">
  <style>
    /* Cart page: no horizontal scroll, scoped to .cart-page */
    .cart-page { overflow-x: hidden; box-sizing: border-box; }
    .cart-page *, .cart-page *::before, .cart-page *::after { box-sizing: border-box; }
    /* Desktop: show table, hide mobile cards */
    .cart-page .cart-table-desktop { display: block; }
    .cart-page .cart-cards-mobile { display: none; }
    @media (max-width: 768px) {
      .cart-page .cart-table-desktop { display: none !important; }
      .cart-page .cart-cards-mobile { display: block !important; }
      /* Mobile card container */
      .cart-page .cart-cards-mobile .cart-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1rem;
        margin-bottom: 1rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
      }
      /* Row 1: image (right in LTR) + name + remove (RTL-friendly) */
      .cart-page .cart-cards-mobile .cart-card-head {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
      }
      .cart-page .cart-cards-mobile .cart-card-head .cart-card-product {
        flex: 1 1 auto;
        min-width: 0;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
      }
      .cart-page .cart-cards-mobile .cart-card-head .cart-card-product img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        flex-shrink: 0;
      }
      .cart-page .cart-cards-mobile .cart-card-head .cart-card-product .cart-card-name {
        flex: 1;
        min-width: 0;
        margin: 0;
        font-size: 0.9375rem;
        line-height: 1.35;
      }
      .cart-page .cart-cards-mobile .cart-card-head .cart-card-product .cart-card-name a { color: inherit; text-decoration: none; }
      .cart-page .cart-cards-mobile .cart-card-head .cart-card-remove {
        flex-shrink: 0;
        min-height: 40px;
        min-width: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.25rem;
        padding: 0.35rem 0.5rem;
        font-size: 0.8125rem;
        color: #b91c1c;
        background: transparent;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;
      }
      .cart-page .cart-cards-mobile .cart-card-head .cart-card-remove:hover { background: #fef2f2; }
      .cart-page .cart-cards-mobile .cart-card-head .cart-card-remove i { font-size: 1.125rem; }
      /* Row 2: unit price + line total */
      .cart-page .cart-cards-mobile .cart-card-prices {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
        padding: 0.5rem 0;
        border-top: 1px solid #f3f4f6;
        border-bottom: 1px solid #f3f4f6;
      }
      .cart-page .cart-cards-mobile .cart-card-prices .product-unit-price { margin: 0; font-size: 0.875rem; }
      .cart-page .cart-cards-mobile .cart-card-prices .cart-card-total { margin: 0; font-weight: 600; font-size: 1rem; }
      /* Row 3: qty controls full width, touch-friendly */
      .cart-page .cart-cards-mobile .cart-card-qty {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0;
      }
      .cart-page .cart-cards-mobile .cart-card-qty .qty ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        overflow: hidden;
      }
      .cart-page .cart-cards-mobile .cart-card-qty .qty ul li {
        margin: 0;
        padding: 0;
      }
      .cart-page .cart-cards-mobile .cart-card-qty .qtminus1,
      .cart-page .cart-cards-mobile .cart-card-qty .qtplus1 {
        min-width: 44px;
        min-height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background: #f9fafb;
        -webkit-tap-highlight-color: transparent;
      }
      .cart-page .cart-cards-mobile .cart-card-qty .qtminus1:hover,
      .cart-page .cart-cards-mobile .cart-card-qty .qtplus1:hover { background: #f3f4f6; }
      .cart-page .cart-cards-mobile .cart-card-qty .qttotal1 {
        min-width: 44px;
        min-height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1rem;
      }
      /* Options (size/color/attrs) */
      .cart-page .cart-cards-mobile .cart-card-options {
        font-size: 0.8125rem;
        color: #6b7280;
        margin-bottom: 0.5rem;
        line-height: 1.5;
      }
      .cart-page .cart-cards-mobile .cart-card-options .color-swatch {
        display: inline-block;
        width: 14px;
        height: 14px;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        vertical-align: middle;
      }
    }
  </style>
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="left-area">
          @include('includes.form-success')
          {{-- Mobile: clean cart item cards (no horizontal scroll) --}}
          <div class="cart-cards-mobile">
            @if(Session::has('cart'))
            @foreach($products as $product)
            @php
              $itemKey = $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']);
            @endphp
            <div class="cart-card cremove{{ $itemKey }}">
              <div class="cart-card-head">
                <div class="cart-card-product">
                  <p class="cart-card-name name"><a href="{{ route('front.product', ['slug' => $product['item']['slug'],'lang' => $sign ]) }}">
                    @if(!$slang) @if($lang->id == 2) {!! strlen($product['item']['name_ar']) > 60 ? substr($product['item']['name_ar'],0,60).'...' : $product['item']['name_ar'] !!} @else {{ strlen($product['item']['name']) > 40 ? substr($product['item']['name'],0,40).'...' : $product['item']['name'] }} @endif
                    @else @if($slang == 2) {!! strlen($product['item']['name_ar']) > 60 ? substr($product['item']['name_ar'],0,60).'...' : $product['item']['name_ar'] !!} @else {{ strlen($product['item']['name']) > 40 ? substr($product['item']['name'],0,40).'...' : $product['item']['name'] }} @endif
                    @endif
                  </a></p>
                  <img src="{{ $product['item']['photo'] ? filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ? $product['item']['photo'] : asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" alt="">
                </div>
                <button type="button" class="cart-card-remove removecart cart-remove" data-class="cremove{{ $itemKey }}" data-href="{{ route('product.cart.remove', $itemKey) }}" aria-label="{{ $langg->lang76 }}">
                  <i class="icofont-ui-delete"></i>
                  <span>{{ $langg->lang76 }}</span>
                </button>
              </div>
              @if(!empty($product['size']) || !empty($product['color']) || !empty($product['keys']))
              <div class="cart-card-options">
                @if(!empty($product['size'])) <span><b>{{ $langg->lang312 }}</b>: {{ $product['item']['measure'] }}{{ $product['size'] }}</span> @endif
                @if(!empty($product['color'])) <span><b>{{ $langg->lang313 }}</b>: <span class="color-swatch" style="background:#{{ $product['color'] == '' ? 'fff' : $product['color'] }};"></span></span> @endif
                @if(!empty($product['keys']))
                  @foreach(array_combine(explode(',', $product['keys']), explode(',', $product['values'])) as $key => $value)
                    @php $atrr = App\Models\Attribute::where('input_name',$key)->first(); $atrroption = App\Models\AttributeOption::where('name',$value)->first(); @endphp
                    <span><b>{{ $atrr ? ($slang == 2 ? ucwords(str_replace('_',' ',$atrr->name_ar)) : ucwords(str_replace('_',' ',$atrr->name))) : ucwords(str_replace('_',' ',$key)) }}</b>: {{ $atrroption ? ($slang == 2 ? $atrroption->name_ar : $atrroption->name) : $value }}</span>
                    @if(!$loop->last) <br> @endif
                  @endforeach
                @endif
              </div>
              @endif
              <div class="cart-card-prices">
                <span class="product-unit-price">{{ App\Models\Product::convertPrice($product['item']['price']) }}</span>
                <span id="prc{{ $itemKey }}" class="cart-card-total">{{ App\Models\Product::convertPrice($product['price']) }}</span>
              </div>
              @if($product['item']['type'] == 'Physical')
              <div class="cart-card-qty">
                <div class="qty">
                  <ul>
                    <input type="hidden" class="prodid" value="{{ $product['item']['id'] }}">
                    <input type="hidden" class="itemid" value="{{ $itemKey }}">
                    <input type="hidden" class="size_qty" value="{{ $product['size_qty'] }}">
                    <input type="hidden" class="size_price" value="{{ $product['item']['price'] }}">
                    <li><span class="qtminus1 reducing" role="button"><i class="icofont-minus"></i></span></li>
                    <li><span class="qttotal1" id="qty{{ $itemKey }}">{{ $product['qty'] }}</span></li>
                    <li><span class="qtplus1 adding" role="button"><i class="icofont-plus"></i></span></li>
                  </ul>
                </div>
              </div>
              @if($product['size_qty']) <input type="hidden" id="stock{{ $itemKey }}" value="{{ $product['size_qty'] }}"> @else <input type="hidden" id="stock{{ $itemKey }}" value="{{ $product['stock'] }}"> @endif
              @else
              <input type="hidden" id="stock{{ $itemKey }}" value="1">
              @endif
            </div>
            @endforeach
            @endif
          </div>
          {{-- Desktop: table (unchanged) --}}
          <div class="cart-table cart-table-desktop">
            <table class="table">
              <thead>
                <tr>
                  <th>{{ $langg->lang122 }}</th>
                  <th width="30%">{{ $langg->lang539 }}</th>
                  <th>{{ $langg->lang125 }}</th>
                  <th>{{ $langg->lang126 }}</th>
                  <th><i class="icofont-close-squared-alt"></i></th>
                </tr>
              </thead>
              <tbody>
                @if(Session::has('cart'))

                @foreach($products as $product)
                <tr
                  class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}">
                  <td class="product-img">
                    <div class="item">
                      <img
                        src="{{ $product['item']['photo'] ? filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ? $product['item']['photo'] : asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}"
                        alt="">
                      <p class="name"><a
                          href="{{ route('front.product', ['slug' => $product['item']['slug'],'lang' => $sign ]) }}">
                          @if(!$slang)
                          @if($lang->id == 2)
                          {!!strlen($product['item']['name_ar']) > 100 ? substr($product['item']['name_ar'],0,100).'...'
                          : $product['item']['name_ar']!!}
                          @else
                          {{strlen($product['item']['name']) > 35 ? substr($product['item']['name'],0,35).'...' :
                          $product['item']['name']}}
                          @endif
                          @else
                          @if($slang == 2)
                          {!!strlen($product['item']['name_ar']) > 100 ? substr($product['item']['name_ar'],0,100).'...'
                          : $product['item']['name_ar']!!}
                          @else
                          {{strlen($product['item']['name']) > 35 ? substr($product['item']['name'],0,35).'...' :
                          $product['item']['name']}}
                          @endif
                          @endif</a></p>
                    </div>
                  </td>
                  <td>
                    @if(!empty($product['size']))
                    <b>{{ $langg->lang312 }}</b>: {{ $product['item']['measure'] }}{{$product['size']}} <br>
                    @endif
                    @if(!empty($product['color']))
                    <div class="d-flex mt-2">
                      <b>{{ $langg->lang313 }}</b>: <span id="color-bar"
                        style="border: 10px solid #{{$product['color'] == "" ? " white" : $product['color']}};"></span>
                    </div>
                    @endif

                    @if(!empty($product['keys']))

                    @foreach( array_combine(explode(',', $product['keys']), explode(',', $product['values'])) as $key =>
                    $value)
                    @php
                    $atrr = App\Models\Attribute::where('input_name',$key)->first();
                    $atrroption = App\Models\AttributeOption::where('name',$value)->first();

                    @endphp


                    <b>@if($atrr)
                      @if(!$slang)
                      @if($lang->id == 2)
                      {{ ucwords(str_replace('_', ' ', $atrr->name_ar)) }} :
                      @else
                      {{ ucwords(str_replace('_', ' ', $atrr->name)) }} :
                      @endif
                      @else
                      @if($slang == 2)
                      {{ ucwords(str_replace('_', ' ', $atrr->name_ar)) }} :
                      @else
                      {{ ucwords(str_replace('_', ' ', $atrr->name)) }} :
                      @endif
                      @endif
                      @else

                      {{ ucwords(str_replace('_', ' ', $key)) }} :
                      @endif </b> @if($atrroption)
                    @if(!$slang)
                    @if($lang->id == 2)
                    {{$atrroption->name_ar}}
                    @else
                    {{$atrroption->name}}
                    @endif
                    @else
                    @if($slang == 2)
                    {{$atrroption->name_ar}}
                    @else
                    {{$atrroption->name}}
                    @endif
                    @endif
                    @else

                    {{ $value }}
                    @endif <br>
                    @endforeach

                    @endif

                  </td>




                  <td class="unit-price quantity">
                    <p class="product-unit-price">
                      {{ App\Models\Product::convertPrice($product['item']['price']) }}
                    </p>
                    @if($product['item']['type'] == 'Physical')

                    <div class="qty">
                      <ul>
                        <input type="hidden" class="prodid" value="{{$product['item']['id']}}">
                        <input type="hidden" class="itemid"
                          value="{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">
                        <input type="hidden" class="size_qty" value="{{$product['size_qty']}}">
                        <!--<input type="hidden" class="size_price" value="{{$product['size_price']}}">   -->

                        <input type="hidden" class="size_price" value="{{$product['item']['price']}}">

                        <li>
                          <span class="qtminus1 reducing">
                            <i class="icofont-minus"></i>
                          </span>
                        </li>
                        <li>
                          <span class="qttotal1"
                            id="qty{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">{{
                            $product['qty'] }}</span>
                        </li>
                        <li>
                          <span class="qtplus1 adding">
                            <i class="icofont-plus"></i>
                          </span>
                        </li>
                      </ul>
                    </div>
                    @endif


                  </td>

                  @if($product['size_qty'])
                  <input type="hidden"
                    id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}"
                    value="{{$product['size_qty']}}">
                  @elseif($product['item']['type'] != 'Physical')
                  <input type="hidden"
                    id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}"
                    value="1">
                  @else
                  <input type="hidden"
                    id="stock{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}"
                    value="{{$product['stock']}}">
                  @endif


                  <td class="total-price">
                    <p
                      id="prc{{$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])}}">
                      {{ App\Models\Product::convertPrice($product['price']) }}
                    </p>
                  </td>
                  <td>
                    <span class="removecart cart-remove"
                      data-class="cremove{{ $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']) }}"
                      data-href="{{ route('product.cart.remove',$product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values'])) }}"><i
                        class="icofont-ui-delete"></i> </span>
                  </td>
                </tr>
                @endforeach

                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
      @if(Session::has('cart'))
      <div class="col-lg-4">
        <div class="right-area">
          <div class="order-box">
            <h4 class="title">{{ $langg->lang127 }}</h4>
            <ul class="order-list">
              <li>
                <p>
                  {{ $langg->lang128 }}
                </p>
                <P>
                  <b class="cart-total">{{ Session::has('cart') ? App\Models\Product::convertPrice($totalPrice) : '0.00'
                    }}</b>
                </P>
              </li>
              <li>
                <p>
                  {{ $langg->lang129 }}
                </p>
                <P>
                  <b class="discount">{{ App\Models\Product::convertPrice(0)}}</b>
                  <input type="hidden" id="d-val" value="{{ App\Models\Product::convertPrice(0)}}">
                </P>
              </li>
              @if($tx)
              <li>
                <p>
                  {{ $langg->lang130 }}
                </p>
                <P>
                  <b>{{$tx}}%</b>
                </P>
              </li>
              @endif
            </ul>
            <div class="total-price">
              <p>
                {{ $langg->lang131 }}
              </p>
              <p>
                <span class="main-total">{{ Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00'
                  }} {{-- $curr->sign --}} </span>
              </p>
            </div>
            <!--  <div class="cupon-box">
              <div id="coupon-link">
                  {{ $langg->lang132 }}
              </div>
              <form id="coupon-form" class="coupon">
                <input type="text" placeholder="{{ $langg->lang133 }}" id="code" required="" autocomplete="off">
                <input type="hidden" class="coupon-total" id="grandtotal" value="{{ Session::has('cart') ? App\Models\Product::convertPrice($mainTotal) : '0.00' }}">
                <button type="submit">{{ $langg->lang134 }}</button>
              </form>
            </div>-->

            <script async src="https://static.addtoany.com/menu/page.js"></script>

            <script src="https://checkout.tabby.ai/tabby-promo.js"></script>


            <!--<div id="tabby-promo" class="mb-2">-->

            <!--</div>-->
            <!--<img src="{{asset('assets/demo_11111/assets/images/pyments.png')}}" class="w-100 my-4">-->
            <a href="{{ route('front.checkout',$sign) }}" class="order-btn">
              {{ $langg->lang135 }}
            </a>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>

</section>
<!-- Cart Area End -->

@endsection

@section('scripts')
<script>
  new window.TabbyPromo({
  selector: '#tabby-promo',
  currency: '{{ $curr->name }}', // or SAR, BHD, KWD, EGP
  lang: '{{ Request::segment(1) }}', // or ar
  price: '{{ round(App\Models\Product::getPurePrice($totalPrice)) }}',
});
</script>
@if(!empty($gtmAddToCart))
{{-- GTM add_to_cart when add was done via redirect (success page state) --}}
<script>
(function(){
  window.dataLayer = window.dataLayer || [];
  var pending = @json($gtmAddToCart);
  var value = (typeof pending.price === 'number' ? pending.price : 0) * (pending.quantity || 1);
  var items = [{ item_id: pending.item_id || undefined, item_name: pending.item_name || undefined, item_category: pending.item_category || undefined, price: typeof pending.price === 'number' ? pending.price : 0, quantity: pending.quantity || 1 }];
  window.dataLayer.push({ ecommerce: null });
  var payload = { event: 'add_to_cart', _event: 'add_to_cart', currency: pending.currency || 'SAR', value: value, items: items, ecommerce: { currency: pending.currency || 'SAR', value: value, items: items } };
  window.dataLayer.push(payload);
  if (window.console && window.console.log) window.console.log('[DL PUSH] add_to_cart (from redirect)', payload);
})();
</script>
@endif
@endsection