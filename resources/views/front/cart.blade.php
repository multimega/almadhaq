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
<section class="cartpage">
  <style>
    .cartpage { overflow-x: hidden; }
    .cartpage .container { max-width: 100%; }
    @media (max-width: 767px) {
      .cartpage .cart-table-mobile .cart-mobile-card {
        display: block;
        border: 1px solid #eee;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
        background: #fff;
      }
      .cartpage .cart-table-mobile .cart-mobile-card .cart-mobile-row { margin-bottom: 0.5rem; }
      .cartpage .cart-table-mobile .cart-mobile-card .cart-mobile-product img { max-width: 80px; height: auto; }
      .cartpage .cart-table-mobile .cart-mobile-card .cart-mobile-actions { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem; margin-top: 0.75rem; }
    }
  </style>
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="left-area">
          @include('includes.form-success')
          {{-- Mobile: stacked cards (no horizontal scroll) --}}
          <div class="cart-table-mobile d-md-none">
            @if(Session::has('cart'))
            @foreach($products as $product)
            @php
              $itemKey = $product['item']['id'].$product['size'].$product['color'].str_replace(str_split(' ,'),'',$product['values']);
            @endphp
            <div class="cart-mobile-card cremove{{ $itemKey }}">
              <div class="cart-mobile-row cart-mobile-product">
                <img src="{{ $product['item']['photo'] ? filter_var($product['item']['photo'], FILTER_VALIDATE_URL) ? $product['item']['photo'] : asset('assets/images/products/'.$product['item']['photo']):asset('assets/images/noimage.png') }}" alt="">
                <p class="name"><a href="{{ route('front.product', ['slug' => $product['item']['slug'],'lang' => $sign ]) }}">
                  @if(!$slang) @if($lang->id == 2) {!! strlen($product['item']['name_ar']) > 60 ? substr($product['item']['name_ar'],0,60).'...' : $product['item']['name_ar'] !!} @else {{ strlen($product['item']['name']) > 35 ? substr($product['item']['name'],0,35).'...' : $product['item']['name'] }} @endif
                  @else @if($slang == 2) {!! strlen($product['item']['name_ar']) > 60 ? substr($product['item']['name_ar'],0,60).'...' : $product['item']['name_ar'] !!} @else {{ strlen($product['item']['name']) > 35 ? substr($product['item']['name'],0,35).'...' : $product['item']['name'] }} @endif
                  @endif
                </a></p>
              </div>
              <div class="cart-mobile-row cart-mobile-options">
                @if(!empty($product['size'])) <b>{{ $langg->lang312 }}</b>: {{ $product['item']['measure'] }}{{ $product['size'] }} @endif
                @if(!empty($product['color'])) <div><b>{{ $langg->lang313 }}</b>: <span style="border: 8px solid #{{ $product['color'] == '' ? 'fff' : $product['color'] }};"></span></div> @endif
                @if(!empty($product['keys']))
                  @foreach(array_combine(explode(',', $product['keys']), explode(',', $product['values'])) as $key => $value)
                    @php $atrr = App\Models\Attribute::where('input_name',$key)->first(); $atrroption = App\Models\AttributeOption::where('name',$value)->first(); @endphp
                    <b>{{ $atrr ? ($slang == 2 ? ucwords(str_replace('_',' ',$atrr->name_ar)) : ucwords(str_replace('_',' ',$atrr->name))) : ucwords(str_replace('_',' ',$key)) }}</b>: {{ $atrroption ? ($slang == 2 ? $atrroption->name_ar : $atrroption->name) : $value }} <br>
                  @endforeach
                @endif
              </div>
              <div class="cart-mobile-actions">
                <p class="product-unit-price mb-0">{{ App\Models\Product::convertPrice($product['item']['price']) }}</p>
                @if($product['item']['type'] == 'Physical')
                <div class="qty">
                  <ul>
                    <input type="hidden" class="prodid" value="{{ $product['item']['id'] }}">
                    <input type="hidden" class="itemid" value="{{ $itemKey }}">
                    <input type="hidden" class="size_qty" value="{{ $product['size_qty'] }}">
                    <input type="hidden" class="size_price" value="{{ $product['item']['price'] }}">
                    <li><span class="qtminus1 reducing"><i class="icofont-minus"></i></span></li>
                    <li><span class="qttotal1" id="qty{{ $itemKey }}">{{ $product['qty'] }}</span></li>
                    <li><span class="qtplus1 adding"><i class="icofont-plus"></i></span></li>
                  </ul>
                </div>
                @endif
                @if($product['size_qty']) <input type="hidden" id="stock{{ $itemKey }}" value="{{ $product['size_qty'] }}"> @elseif($product['item']['type'] != 'Physical') <input type="hidden" id="stock{{ $itemKey }}" value="1"> @else <input type="hidden" id="stock{{ $itemKey }}" value="{{ $product['stock'] }}"> @endif
                <p id="prc{{ $itemKey }}" class="mb-0">{{ App\Models\Product::convertPrice($product['price']) }}</p>
                <span class="removecart cart-remove" data-class="cremove{{ $itemKey }}" data-href="{{ route('product.cart.remove', $itemKey) }}"><i class="icofont-ui-delete"></i></span>
              </div>
            </div>
            @endforeach
            @endif
          </div>
          {{-- Desktop: table --}}
          <div class="cart-table cart-table-desktop d-none d-md-block">
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