@extends('layouts.front_34')


@section('content')

@php 
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
@endphp

<!-- SubCategori Area Start -->
<section class="sub-categori brands-p">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 order-first order-lg-last ajax-loader-parent">
                <div class="right-area" id="app">
                    <div class="categori-item-area">
                        <div class="row" id="ajaxContent">
                            @foreach($brands as $brand)
                                <div class="col-sm-3">
                                    @if(!$slang)
                                        @if($lang->id == 2)
                                  	        <a  href="{{route('front.f-singlebrands',['slug' => $brand->slug_ar , 'lang' => $sign ])}}" class="item">
                                        @else 
                  	                        <a  href="{{route('front.f-singlebrands',['slug' => $brand->slug , 'lang' => $sign ])}}" class="item">
                                        @endif 
                                    @else  
                                        @if($slang == 2) 
                                     	    <a  href="{{route('front.f-singlebrands',['slug' => $brand->slug_ar , 'lang' => $sign ])}}" class="item">
                                        @else
                                     	    <a  href="{{route('front.f-singlebrands',['slug' => $brand->slug , 'lang' => $sign ])}}" class="item">
                                        @endif
                                    @endif
        						    <div class="item-img">
        								<img class="img-fluid" src="{{ $brand->photo ? asset('assets/images/brands/'.$brand->photo):asset('assets/images/noimage.png') }}"  style="height:140.398px;" alt="">
        								<p>{{$langg->rtl == 1  ? $brand->name_ar : $brand->name}}</p>
        							</div>
						                    </a>
						        </div>
					        @endforeach
                        </div>
                        <div id="ajaxLoader" class="ajax-loader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center rgba(0,0,0,.6);"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection