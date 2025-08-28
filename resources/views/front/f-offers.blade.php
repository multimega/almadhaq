@extends('layouts.front_34')
@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
$tool = DB::table('seotools')->find(1);


@endphp


@section('offersmeta')

   
   @if(isset($offers->title) ||  isset($offers->title_ar)) 
       
        <title>	@if(!$slang)
              @if($lang->id == 2)
             {!!substr($offers->title_ar, 0,50)."-"!!}{{$gs->title_ar}}
              @else 
             {{substr($offers->title, 0,50)."-"}}{{$gs->title}}
              @endif 
          @else  
              @if($slang == 2) 
              {!!substr($offers->title_ar, 0,50)."-"!!}{{$gs->title_ar}}
              @else
              {{substr($offers->title, 0,50)."-"}}{{$gs->title}}
              @endif
          @endif</title>
   @endif


     
   
   @if(isset($offers->meta_keys) ||  isset($offers->meta_keys_ar)) 
       
          
          @if(!$slang)
              @if($lang->id == 2)
            
                @if(isset($offers->meta_keys))
	        <meta name="keywords" content="{!!$offers->meta_keys_ar!!}">
	     @endif
	   
              @else 
                  @if(isset($offers->meta_keys))
                 <meta name="keywords" content="{{$offers->meta_keys}}">
	       @endif
              @endif 


              @else  
                 @if($slang == 2) 

                   @if(isset($offers->meta_keys_ar))
                 <meta name="keywords" content="{!!$offers->meta_keys_ar!!}">
	           @endif
              @else

                   @if(isset($offers->meta_keys))
                  <meta name="keywords" content="{{$offers->meta_keys}}">
                    @endif
              @endif
          @endif

   @endif



   @if(isset($offers->meta_description) ||  isset($offers->meta_description_ar)) 
       
          
          @if(!$slang)
              @if($lang->id == 2)
            
                @if(isset($offers->meta_description_ar))
	        <meta name="description" content="{!!$offers->meta_description_ar!!}">
	     @endif
	   
              @else 
                  @if(isset($offers->meta_description))
                 <meta name="description" content="{{$offers->meta_description}}">
	       @endif
              @endif 


              @else  
                 @if($slang == 2) 

                   @if(isset($offers->meta_description_ar))
                 <meta name="description" content="{!!$offers->meta_description_ar!!}">
	           @endif
              @else

                   @if(isset($offers->meta_description))
                  <meta name="description" content="{{$offers->meta_description}}">
                    @endif
              @endif
          @endif

   @endif

   
  
          @if(isset($tool->offer_analytics ))  
          
            {!! $seo->offer_analytics !!}


            @endif




@stop


@section('content')
@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();


@endphp
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
   <div class="">
      <div class="row m-0">
         <div class="col-lg-12 p-0">
            <ul class="pages breadcrumb mb-0">
               <li class="breadcrumb-item">
                  <a href="{{route('front.index',$sign)}}">{{ $langg->lang17 }}</a>
               </li>
               @if (!empty($cat))
               <li class="breadcrumb-item">
                
             @if(!$slang)
              @if($lang->id == 2)
                <a href="{{route('front.category',[ 'category' => $cat->slug_ar ,'lang' => $sign ])}}">
              {{ $cat->name_ar }}
              @else 
                <a href="{{route('front.category',[ 'category' => $cat->slug ,'lang' => $sign ])}}">
              {{ $cat->name }}
              @endif 
          @else  
              @if($slang == 2) 
                <a href="{{route('front.category', [ 'category' => $cat->slug_ar ,'lang' => $sign ])}}">
              {{ $cat->name_ar }}
              @else
                <a href="{{route('front.category', [ 'category' => $cat->slug ,'lang' => $sign ])}}">
              {{ $cat->name }}
              @endif
          @endif</a>
               </li>
               @endif
               @if (!empty($subcat))
               <li class="breadcrumb-item">
                          
                  @if(!$slang)
              @if($lang->id == 2)
                <a href="{{route('front.category',  [ 'category' => $cat->slug_ar , 'subcategory' => $subcat->slug_ar ,'lang' => $sign ])}}">   
              {{ $subcat->name_ar }}
              @else 
                <a href="{{route('front.category',  [ 'category' => $cat->slug , 'subcategory' => $subcat->slug ,'lang' => $sign ])}}">   
              {{ $subcat->name }}
              @endif 
          @else  
              @if($slang == 2) 
                <a href="{{route('front.category', [ 'category' => $cat->slug_ar , 'subcategory' => $subcat->slug_ar ,'lang' => $sign ])}}">   
              {{ $subcat->name_ar }}
              @else
                <a href="{{route('front.category',  [ 'category' => $cat->slug , 'subcategory' => $subcat->slug ,'lang' => $sign ])}}">   
              {{ $subcat->name }}
              @endif
          @endif</a>
               </li>
               @endif
               @if (!empty($childcat))
               <li class="breadcrumb-item">
                 
                                   @if(!$slang)
              @if($lang->id == 2)
               <a href="{{route('front.category', [ 'category' => $cat->slug_ar , 'subcategory' => $subcat->slug_ar,  'childcategory' => $childcat->slug_ar ,'lang' => $sign ])}}">
              {{ $childcat->name_ar }}
              @else 
               <a href="{{route('front.category',  [ 'category' => $cat->slug , 'subcategory' => $subcat->slug,  'childcategory' => $childcat->slug ,'lang' => $sign ])}}">
              {{ $childcat->name }}
              @endif 
          @else  
              @if($slang == 2) 
               <a href="{{route('front.category',  [ 'category' => $cat->slug_ar , 'subcategory' => $subcat->slug_ar,  'childcategory' => $childcat->slug_ar ,'lang' => $sign ])}}">
              {{ $childcat->name_ar }}
              @else
               <a href="{{route('front.category',  [ 'category' => $cat->slug , 'subcategory' => $subcat->slug,  'childcategory' => $childcat->slug ,'lang' => $sign ])}}">
              {{ $childcat->name }}
              @endif
          @endif</a>
               </li>
               @endif
               @if (empty($childcat) && empty($subcat) && empty($cat))
               <li class="breadcrumb-item">
                @if(!$slang)
                  @if($lang->id == 2)
                    <a href="{{route('front.offers',['slug' => $offers->slug_ar , 'lang' => $sign ])}}">
                {{ $offers->name_ar }}
                  @else 
                    <a href="{{route('front.offers',['slug' => $offers->slug , 'lang' => $sign ])}}">
                {{ $offers->name }}
                  @endif 
                @else  
                  @if($slang == 2) 
                    <a href="{{route('front.offers',['slug' => $offers->slug_ar , 'lang' => $sign ])}}">
                 {{ $offers->name_ar }}
                  @else
                    <a href="{{route('front.offers',['slug' => $offers->slug , 'lang' => $sign ])}}">
                 {{ $offers->name }}
                  @endif
          @endif</a>
               </li>
               @endif
            </ul>
         </div>
      </div>
   </div>
</div>
<!-- Breadcrumb Area End -->

<section class="sub-categori f-p-main">
   <!--<div class="container">-->
      <div class="row m-0">
          <!--Start Filter-->
          <div class="col-lg-2 col-md-6">
          <div class="left-area">
            <div class="filter-result-area">
            <div class="header-area">
              <h5 class="title">
                {{$langg->lang61}}
              </h5>
            </div>
            <div class="body-area">
                
              <form id="catalogForm" action="{{ route('front.f-category', ['category' => Request::route('category'),'subcategory' =>Request::route('subcategory'),'childcategory' =>Request::route('childcategory'),'lang' => $sign]) }}" method="GET">
                @if (!empty(request()->input('search')))
                  <input type="hidden" name="search" value="{{ request()->input('search') }}">
                @endif
                @if (!empty(request()->input('sort')))
                  <input type="hidden" name="sort" value="{{ request()->input('sort') }}">
                @endif
                <!--<ul class="filter-list">-->
                    <!-- Start Filter Categories Group -->
                    <div class="filter-group mb-4">
                        <h3 class="filter-group-head d-flex justify-content-between"><span>Category</span> <span><i class="fas fa-chevron-down"></i></span></h3>
                        <div class="show-hidden-filtering">
                            @foreach ($categories as $element)
                                @if(!$slang)
                                    @if($lang->id == 2)
                                    <h6><a href="{{route('front.f-category', ['category' => $element->slug_ar , 'lang' => $sign ])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="category-link"> <i class="fas fa-angle-double-right"></i>
                                    {{$element->name_ar}}
                                    @else 
                                    <h6><a href="{{route('front.f-category', ['category' => $element->slug , 'lang' => $sign ])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="category-link"> <i class="fas fa-angle-double-right"></i>
                                    {{$element->name}}
                                    @endif 
                                @else  
                                    @if($slang == 2) 
                                    <h6><a href="{{route('front.f-category',  ['category' => $element->slug_ar , 'lang' => $sign ])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="category-link">
                                    {{$element->name_ar}}
                                    @else
                                    <h6><a href="{{route('front.f-category', ['category' => $element->slug , 'lang' => $sign ])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="category-link">
                                    {{$element->name}}
                                    @endif
                                @endif</a></h6>
                                @if(!empty($cat) && $cat->id == $element->id && !empty($cat->subs))
                                    @foreach ($cat->subs as $key => $subelement)
                                        @if(!$slang)
                                            @if($lang->id == 2)
                                            <a href="{{route('front.f-category', ['category' => $cat->slug_ar ,'subcategory' =>  $subelement->slug_ar, 'lang' => $sign ] )}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="d-flex justify-content-between align-content-center">
                                            {{$subelement->name_ar}}
                                            @else 
                                            <a href="{{route('front.f-category', ['category' => $cat->slug ,'subcategory' =>  $subelement->slug, 'lang' => $sign ])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="d-flex justify-content-between align-content-center">
                                            {{$subelement->name}}
                                            @endif 
                                        @else  
                                            @if($slang == 2) 
                                            <a href="{{route('front.f-category', ['category' => $cat->slug_ar ,'subcategory' =>  $subelement->slug_ar, 'lang' => $sign ])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="d-flex justify-content-between align-content-center">
                                            {{$subelement->name_ar}}
                                            @else
                                            <a href="{{route('front.f-category', ['category' => $cat->slug ,'subcategory' =>  $subelement->slug, 'lang' => $sign ])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="d-flex justify-content-between align-content-center">
                                            {{$subelement->name}}
                                            @endif
                                        @endif</a>
                                        @if(!empty($subcat) && $subcat->id == $subelement->id && !empty($subcat->childs))
                                            @foreach ($subcat->childs as $key => $childcat)
                                                @if(!$slang)
                                                    @if($lang->id == 2)
                                                    <a href="{{route('front.f-category',  ['category' => $cat->slug_ar ,'subcategory' => $subcat->slug_ar ,'childcategory' =>  $childcat->slug_ar, 'lang' => $sign ])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="mx-3 d-flex justify-content-between align-content-center">
                                                    {{$childcat->name_ar}}
                                                    @else 
                                                    <a href="{{route('front.f-category', ['category' => $cat->slug ,'subcategory' => $subcat->slug ,'childcategory' =>  $childcat->slug, 'lang' => $sign ])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="mx-3 d-flex justify-content-between align-content-center">
                                                    {{$childcat->name}}
                                                    @endif 
                                                @else  
                                                    @if($slang == 2) 
                                                    <a href="{{route('front.f-category',['category' => $cat->slug_ar ,'subcategory' => $subcat->slug_ar ,'childcategory' =>  $childcat->slug_ar, 'lang' => $sign ])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="mx-3 d-flex justify-content-between align-content-center">
                                                    {{$childcat->name_ar}}
                                                    @else
                                                    <a href="{{route('front.f-category',['category' => $cat->slug ,'subcategory' => $subcat->slug ,'childcategory' =>  $childcat->slug, 'lang' => $sign ])}}{{!empty(request()->input('search')) ? '?search='.request()->input('search') : ''}}" class="mx-3 d-flex justify-content-between align-content-center">
                                                    {{$childcat->name}}
                                                    @endif
                                                @endif </a>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                           @endforeach
                        </div>
                    </div>
                    <!-- End Filter Categories Group -->
                    <!-- Start Price Filter Group -->
                    <div class="filter-group mb-4">
                        <h3 class="filter-group-head d-flex justify-content-between"><span>Price</span> <span><i class="fas fa-chevron-down"></i></span></h3>
                        <div class="show-hidden-filtering price-filter">
                                <div class="form-row d-flex align-items-center">
                                    <div class="col">
                                        <input type="number" min=0  name="min"  id="min_price" class="form-control">
                                    </div>
                                    {{$langg->lang62}}
                                    <div class="col">
                                        <input type="number" min=0  name="max" id="max_price" class="form-control">
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!--End Filter by Price-->
                    
                    <!-- Start Color Filter Group -->
                    <div class="filter-group mb-4">
                        <h3 class="filter-group-head d-flex justify-content-between"><span>Color</span> <span><i class="fas fa-chevron-down"></i></span></h3>
                        <div class="show-hidden-filtering price-filter">
                            @php
                              $colors_data = \App\Models\Color::select('colors')->groupBy('colors')->get();
                            @endphp
                            @foreach($colors_data as $key=>$color)
                               @php
                                    $c = 0;
                                    $ids = \App\Models\Color::where('colors',$color->colors)->pluck('product_id');
                                 
                                    if(!empty($cat) && empty($subcat) && empty($childcat)) {
                                        $cprods = \App\Models\Product::whereIn('id',$ids)->where('category_id',$cat->id)->get();
                                    }
                                     if(!empty($cat) && !empty($subcat) && empty($childcat)) {
                                        $cprods = \App\Models\Product::whereIn('id',$ids)->where('category_id',$cat->id)->where('subcategory_id',$subcat->id)->get();
                                    }
                                     if(!empty($cat) && !empty($subcat) && !empty($childcat)) {
                                        $cprods = \App\Models\Product::whereIn('id',$ids)->where('category_id',$cat->id)->where('subcategory_id',$subcat->id)->where('childcategory_id',$childcat->id)->get();
                                    }   
                                    if(!empty($cprods)) {
                                        $c = count($cprods);
                                    }
                                @endphp
                                
                                <div class="form-check d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <input class="form-check-input m-0 colors_attrs" type="checkbox" name="color[]" value="{{ltrim($color->colors,'#')}}" id="{{$key}}">
                                        <label class="form-check-label d-flex align-items-center" for="{{$key}}"><span style="background-color:{{$color->colors}};width:18px;height:18px;display:inline-block;border:1px solid #000;"></span></label>
                                    </div>
                                    <span>{{$c}}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- End Color Filter Group -->
                    

                  <button class="filter-btn btn btn-primary text-white" type="submit">{{$langg->lang58}}</button>
              </form>
            </div>
            </div>


            @if ((!empty($cat) && !empty(json_decode($cat->attributes, true))) || (!empty($subcat) && !empty(json_decode($subcat->attributes, true))) || (!empty($childcat) && !empty(json_decode($childcat->attributes, true))))

              <div class="tags-area">
                <div class="header-area">
                  <h4 class="title">
                      Filters
                  </h4>
                </div>
                <div class="body-area">
                  <form id="attrForm" action="{{route('front.category', ['category' => Request::route('category'), 'subcategory' =>  Request::route('subcategory'), 'childcategory' => Request::route('childcategory') , 'lang' => $sign])}}" method="post">
                    <ul class="filter p-0">
                      <div class="single-filter">
                        @if (!empty($cat) && !empty(json_decode($cat->attributes, true)))
                          @foreach ($cat->attributes as $key => $attr)
                            <div class="my-2 sub-title">
                              <span><i class="fas fa-arrow-alt-circle-right"></i> @if(!$slang)
              @if($lang->id == 2)
              {{ $attr->name_ar }}
              @else 
              {{ $attr->name }}
              @endif 
          @else  
              @if($slang == 2) 
              {{ $attr->name_ar }}
              @else
              {{ $attr->name }}
              @endif
          @endif</span>
                            </div>
                            @if (!empty($attr->attribute_options))
                              @foreach ($attr->attribute_options as $key => $option)
                                <div class="form-check ml-0 pl-0">
                                  <input name="{{$attr->input_name}}[]" class="attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                                  <label class="" for="{{$attr->input_name}}{{$option->id}}">@if(!$slang)
              @if($lang->id == 2)
              {{ $option->name_ar }}
              @else 
              {{ $option->name }}
              @endif 
          @else  
              @if($slang == 2) 
              {{ $option->name_ar }}
              @else
              {{ $option->name }}
              @endif
          @endif</label>
                                </div>
                              @endforeach
                            @endif
                          @endforeach
                        @endif

                        @if (!empty($subcat) && !empty(json_decode($subcat->attributes, true)))
                          @foreach ($subcat->attributes as $key => $attr)
                          <div class="my-2 sub-title">
                            <span><i class="fas fa-arrow-alt-circle-right"></i> @if(!$slang)
              @if($lang->id == 2)
              {{ $attr->name_ar }}
              @else 
              {{ $attr->name }}
              @endif 
          @else  
              @if($slang == 2) 
              {{ $attr->name_ar }}
              @else
              {{ $attr->name }}
              @endif
          @endif</span>
                          </div>
                            @if (!empty($attr->attribute_options))
                              @foreach ($attr->attribute_options as $key => $option)
                                <div class="form-check  ml-0 pl-0">
                                  <input name="{{$attr->input_name}}[]" class="attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                                  <label class="" for="{{$attr->input_name}}{{$option->id}}">@if(!$slang)
              @if($lang->id == 2)
             {{$option->name}}
              @else 
             {{$option->name}}
              @endif 
          @else  
              @if($slang == 2) 
              {{$option->name}}
              @else
              {{$option->name}}
              @endif
          @endif</label>
                                </div>
                              @endforeach
                            @endif
                          @endforeach
                        @endif

                        @if (!empty($childcat) && !empty(json_decode($childcat->attributes, true)))
                          @foreach ($childcat->attributes as $key => $attr)
                          <div class="my-2 sub-title">
                            <span><i class="fas fa-arrow-alt-circle-right"></i> @if(!$slang)
              @if($lang->id == 2)
              {{$attr->name_ar}}
              @else 
              {{$attr->name}}
              @endif 
          @else  
              @if($slang == 2) 
              {{$attr->name_ar}}
              @else
              {{$attr->name}}
              @endif
          @endif</span>
                          </div>
                            @if (!empty($attr->attribute_options))
                              @foreach ($attr->attribute_options as $key => $option)
                                <div class="form-check  ml-0 pl-0">
                                  <input name="{{$attr->input_name}}[]" class="attribute-input" type="checkbox" id="{{$attr->input_name}}{{$option->id}}" value="{{$option->name}}">
                                  <label class="" for="{{$attr->input_name}}{{$option->id}}">@if(!$slang)
              @if($lang->id == 2)
              {{$option->name_ar}}
              @else 
              {{$option->name}}
              @endif 
          @else  
              @if($slang == 2) 
              {{$option->name_ar}}
              @else
              {{$option->name}}
              @endif
          @endif</label>
                                </div>
                              @endforeach
                            @endif
                          @endforeach
                        @endif
                      </div>
                    </ul>
                  </form>
                </div>
              </div>
            @endif


            @if(!isset($vendor))

            {{-- <div class="tags-area">
                <div class="header-area">
                    <h4 class="title">
                        {{$langg->lang63}}
                    </h4>
                  </div>
                  <div class="body-area">
                    <ul class="taglist p-0">
                      @foreach(App\Models\Product::showTags() as $tag)
                      @if(!empty($tag))
                      <li>
                        <a class="{{ isset($tags) ? ($tag == $tags ? 'active' : '') : ''}}" href="{{ route('front.tag',['slug' => $tag , 'lang' => $sign ]) }}">
                            {{ $tag }}
                        </a>
                      </li>
                      @endif
                      @endforeach
                    </ul>
                  </div>
            </div> --}}


            @else

            <div class="service-center">
              <div class="header-area">
                <h4 class="title">
                    {{ $langg->lang227 }}
                </h4>
              </div>
              <div class="body-area">
                <ul class="list p-0">
                  <li>
                      <a href="javascript:;" data-toggle="modal" data-target="{{ Auth::guard('web')->check() ? '#vendorform1' : '#comment-log-reg' }}">
                          <i class="icofont-email"></i> <span class="service-text">{{ $langg->lang228 }}</span>
                      </a>
                  </li>
                  <li>
                        <a href="tel:+{{$vendor->shop_number}}">
                          <i class="icofont-phone"></i> <span class="service-text">{{$vendor->shop_number}}</span>
                        </a>
                  </li>
                </ul>
              <!-- Modal -->
              </div>

              <div class="footer-area">
                <p class="title">
                  {{ $langg->lang229 }}
                </p>
                <ul class="list p-0">


              @if($vendor->f_check != 0)
              <li><a href="{{$vendor->f_url}}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
              @endif
              @if($vendor->g_check != 0)
              <li><a href="{{$vendor->g_url}}" target="_blank"><i class="fab fa-google"></i></a></li>
              @endif
              @if($vendor->t_check != 0)
              <li><a href="{{$vendor->t_url}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
              @endif
              @if($vendor->l_check != 0)
              <li><a href="{{$vendor->l_url}}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
              @endif


                </ul>
              </div>
            </div>


            @endif


          </div>
        </div>

          <!--End Filter-->
         <!--@include('includes.catalog')-->
         <div class="col-lg-10 px-3 f-p-main-content order-first order-lg-last ajax-loader-parent">
             <div class="row mx-0 justify-content-end align-items-center mb-3">
                 

                <div class="nav-filter d-flex mt-3 mt-md-0">
                    <div>
                        <span>{{$langg->lang64}} :</span>
                        <select id="sortby" name="sort" class="short-item">
    	                    <option value="date_desc">{{$langg->lang65}}</option>
    	                    <option value="date_asc">{{$langg->lang66}}</option>
    	                    <option value="price_asc">{{$langg->lang67}}</option>
    	                    <option value="price_desc">{{$langg->lang68}}</option>
						</select>
                    </div>
                </div>
            </div>
             
             @if (!empty($cat) && empty($subcat) && empty($childcat))

          <div class="cat_desc">
              

                      @if(!$slang)
              @if($lang->id == 2)
                {!!$cat->details_ar!!}
              @else 
              {!!$cat->details!!}
              @endif 
          @else  
              @if($slang == 2) 
              {!!$cat->details_ar!!}
              @else
                 {!!$cat->details!!}
              @endif
          @endif

           <br><br>
         </div>
 
       @endif
              


       @if (!empty($subcat) && !empty($cat) && empty($childcat))

          <div class="subcat_desc">
              

                      @if(!$slang)
              @if($lang->id == 2)
                {!!$subcat->details_ar!!}
              @else 
              {!!$subcat->details!!}
              @endif 
          @else  
              @if($slang == 2) 
              {!!$subcat->details_ar!!}
              @else
                 {!!$subcat->details!!}
              @endif
          @endif

            <br><br>
         </div>
 
@endif
     
              


 @if (!empty($childcat)&& !empty($subcat) && !empty($cat))

          <div class="childcat_desc">
              

                      @if(!$slang)
              @if($lang->id == 2)
                {!!$childcat->details_ar!!}
              @else 
              {!!$childcat->details!!}
              @endif 
          @else  
              @if($slang == 2) 
              {!!$childcat->details_ar!!}
              @else
                 {!!$childcat->details!!}
              @endif
          @endif

           <br><br>  
         </div>
    
 @endif            
   
            <div class="right-area" id="app">
               <div class="categori-item-area">
                 <div class="row" id="ajaxContent">
                   <!-- Start includes.product.filtered-products-->
                   @php 
                        $slang = Session::get('language');
                        $lang  = DB::table('languages')->where('is_default','=',1)->first();
                    @endphp
        			@if (count($prods) > 0)
    					@foreach ($prods as $key => $prod)
    					    @if($prod->status == 1) 
    					        <!--Start A Product-->
								<div class="w-20">
								    <div class="product-box item">
										<div class="product-img">
										    @if(Auth::guard('web')->check())
                                            <a href="javascript::"  data-href="{{ route('user-wishlist-add',$prod->id) }}" class="add-wishlist paction add-wishlist add-to-wish">
                                              <i class="far fa-heart"></i>
                                            </a>
                                            @endif
                                            @if($prod->emptyStock())
                                              <button class="btn-cart-out-of-stock">
                                                <a href="javascript:;" class="cart-out-of-stock">
                                                  <i class="icofont-close-circled"></i>
                                                  {{ $langg->lang78 }}</a>
                                              </button>
                                            @else    
                                            <button class="btn-icon btn-add-cart add-to-cart paction" data-href="{{ route('product.cart.add',$prod->id) }}"  data-toggle="modal" data-target="#addCartModal"><i class="fas fa-shopping-bag"></i></button>
                                            @endif
                                            <img src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/thumbnails/'.$prod->thumbnail):asset('assets/images/noimage.png') }}" 
    											@if(!$slang)
                                                      @if($lang->id == 2)
                                                        alt="{{$prod->alt_ar}}"        
                                                      @else 
                                                        alt="{{$prod->alt}}"    
                                                      @endif 
                                                @else  
                                                    @if($slang == 2) 
                                                      alt="{{$prod->alt_ar}}"    
                                                    @else
                                                      alt="{{$prod->alt}}"    
                                                    @endif
                                                @endif
                                            >
                                        </div>  <!--End Product Image-->
                                        
                                        <!--*******-->
                                        <div class="product-desc px-2 pb-0">
        									@if(!$slang)
                                                @if($lang->id == 2)
                                                  <a href="{{ route('front.product_34',['slug' => $prod->slug_ar ,'lang' => $sign]) }}" class="item">
                                                @else 
                                                   <a href="{{ route('front.product_34', ['slug' => $prod->slug ,'lang' => $sign]) }}" class="item">
                                                @endif 
                                            @else  
                                                @if($slang == 2) 
                                                    <a href="{{ route('front.product_34', ['slug' => $prod->slug_ar ,'lang' => $sign]) }}" class="item">
                                                @else
                                                    <a href="{{ route('front.product_34', ['slug' => $prod->slug ,'lang' => $sign]) }}" class="item">
                                                @endif
                                            @endif
                                                <div class="product-name">
                                                    <h4>
                                                        @if(!$slang)
                                                            @if($lang->id == 2)
                                                            {!! $prod->showName_ar() !!}
                                                            @else 
                                                            {{ $prod->showName() }}
                                                            @endif 
                                                        @else  
                                                            @if($slang == 2) 
                                                            {!! $prod->showName_ar() !!}
                                                            @else
                                                            {{ $prod->showName() }}
                                                            @endif
                                                        @endif
                                                    </h4>
                                                </div>
                                                <div class="product-price mb-2">
                                                    <span class="current-price">
                                                        @if(!$slang)
                                                            @if($lang->id == 2)
                                                            {{ $prod->showPrice_ar() }}
                                                            @else 
                                                            {{ $prod->showPrice() }}
                                                            @endif 
                                                        @else  
                                                            @if($slang == 2) 
                                                            {{ $prod->showPrice_ar() }}
                                                            @else
                                                            {{ $prod->showPrice() }}
                                                            @endif
                                                        @endif
                                                    </span>
                                                    <span class="old-price">
                                                        @if(!$slang)
                                                            @if($lang->id == 2)
                                                                {{ $prod->showPreviousPrice_ar() }}
                                                            @else 
                                                                {{ $prod->showPreviousPrice() }}
                                                            @endif 
                                                        @else  
                                                            @if($slang == 2) 
                                                                {{ $prod->showPreviousPrice_ar() }}
                                                            @else
                                                                {{ $prod->showPreviousPrice() }}
                                                            @endif
                                                        @endif
                                                    </span>
                                                    <!--<span class="percentage text-success">33%</span>-->
                                                </div>
                                                <div class="product-rating d-flex justify-content-between align-items-center">
                                                    <!--<img src="assets/images/express.png">-->
                                                    <span><i class="fas fa-star"></i> {{App\Models\Rating::ratings($prod->id)}}%</span>
                                                </div>
                                            </a>
                                        </div> <!--End Product Description-->
                                    </div>
								</div>
    					        <!--End A Product-->
							@endif
            			@endforeach
        				<div class="col-lg-12">
        					<div class="page-center mt-5">
        						{!! $prods->appends(['search' => request()->input('search')])->links() !!}
        					</div>
        				</div>
        			@else
        				<div class="col-lg-12">
        					<div class="page-center">
        						 <h4 class="text-center">{{ $langg->lang60 }}</h4>
        					</div>
        				</div>
        			@endif
            
            
            @if(isset($ajax_check))
            
            
            <script type="text/javascript">
            
            
            // Tooltip Section
            
            
                $('[data-toggle="tooltip"]').tooltip({
                  });
                  $('[data-toggle="tooltip"]').on('click',function(){
                      $(this).tooltip('hide');
                  });
            
            
            
            
                  $('[rel-toggle="tooltip"]').tooltip();
            
                  $('[rel-toggle="tooltip"]').on('click',function(){
                      $(this).tooltip('hide');
                  });
            
            
            // Tooltip Section Ends
            
            </script>
            
            @endif
                   <!--End includes.product.filtered Products-->
                 </div>
                 <div id="ajaxLoader" class="ajax-loader" style="background: url({{asset('assets/images/'.$gs->loader)}}) no-repeat scroll center center rgba(0,0,0,.6);"></div>
               </div>

            </div>
         </div>
      </div>
   <!--</div>-->
</section>
@endsection

@section('scripts')

<script>

  $(document).ready(function() {

    // when dynamic attribute changes
    $(".attribute-input, #sortby").on('change', function() {
      $("#ajaxLoader").show();
      filter();
    });

    // when price changed & clicked in search button
    $(".filter-btn").on('click', function(e) {
      e.preventDefault();
      $("#ajaxLoader").show();
      filter();
    });
  });

  function filter() {
    let filterlink = '';

    if ($("#prod_name").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category',  [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}' + '?search='+$("#prod_name").val();
      } else {
        filterlink += '&search='+$("#prod_name").val();
      }
    }

    $(".attribute-input").each(function() {
      if ($(this).is(':checked')) {
        if (filterlink == '') {
          filterlink += '{{route('front.category',  [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}' + '?'+$(this).attr('name')+'='+$(this).val();
        } else {
          filterlink += '&'+$(this).attr('name')+'='+$(this).val();
        }
      }
    });

    if ($("#sortby").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category',  [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}' + '?'+$("#sortby").attr('name')+'='+$("#sortby").val();
      } else {
        filterlink += '&'+$("#sortby").attr('name')+'='+$("#sortby").val();
      }
    }

    if ($("#min_price").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category', [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}' + '?'+$("#min_price").attr('name')+'='+$("#min_price").val();
      } else {
        filterlink += '&'+$("#min_price").attr('name')+'='+$("#min_price").val();
      }
    }

    if ($("#max_price").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.category',  [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}' + '?'+$("#max_price").attr('name')+'='+$("#max_price").val();
      } else {
        filterlink += '&'+$("#max_price").attr('name')+'='+$("#max_price").val();
      }
    }

    // console.log(filterlink);
    console.log(encodeURI(filterlink));
    $("#ajaxContent").load(encodeURI(filterlink), function(data) {
      // add query string to pagination
      addToPagination();
      $("#ajaxLoader").fadeOut(1000);
    });
  }

  // append parameters to pagination links
  function addToPagination() {
    // add to attributes in pagination links
    $('ul.pagination li a').each(function() {
      let url = $(this).attr('href');
      let queryString = '?' + url.split('?')[1]; // "?page=1234...."

      let urlParams = new URLSearchParams(queryString);
      let page = urlParams.get('page'); // value of 'page' parameter

      let fullUrl = '{{route('front.category',  [ "category" => Request::route('category'),  "subcategory" =>Request::route('subcategory'),  "childcategory" =>Request::route('childcategory'), "lang" =>$sign])}}?page='+page+'&search='+'{{request()->input('search')}}';

      $(".attribute-input").each(function() {
        if ($(this).is(':checked')) {
          fullUrl += '&'+encodeURI($(this).attr('name'))+'='+encodeURI($(this).val());
        }
      });

      if ($("#sortby").val() != '') {
        fullUrl += '&sort='+encodeURI($("#sortby").val());
      }

      if ($("#min_price").val() != '') {
        fullUrl += '&min='+encodeURI($("#min_price").val());
      }

      if ($("#max_price").val() != '') {
        fullUrl += '&max='+encodeURI($("#max_price").val());
      }

      $(this).attr('href', fullUrl);
    });
  }

  $(document).on('click', '.categori-item-area .pagination li a', function (event) {
    event.preventDefault();
    if ($(this).attr('href') != '#' && $(this).attr('href')) {
      $('#preloader').show();
      $('#ajaxContent').load($(this).attr('href'), function (response, status, xhr) {
        if (status == "success") {
          $('#preloader').fadeOut();
          $("html,body").animate({
            scrollTop: 0
          }, 1);

          addToPagination();
        }
      });
    }
  });

</script>

<script type="text/javascript">

  $(function () {

    $("#slider-range").slider({
      range: true,
      orientation: "horizontal",
      min: 0,
      max: 10000000,
      values: [{{ isset($_GET['min']) ? $_GET['min'] : '0' }}, {{ isset($_GET['max']) ? $_GET['max'] : '10000000' }}],
      step: 5,

      slide: function (event, ui) {
        if (ui.values[0] == ui.values[1]) {
          return false;
        }

        $("#min_price").val(ui.values[0]);
        $("#max_price").val(ui.values[1]);
      }
    });

    $("#min_price").val($("#slider-range").slider("values", 0));
    $("#max_price").val($("#slider-range").slider("values", 1));

  });

</script>



@endsection