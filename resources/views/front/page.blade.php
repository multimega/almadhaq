@extends('layouts.front')
@section('content')
@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();


@endphp
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="pages">
          <li>
            <a href="{{ route('front.index',$sign) }}">
              
            </a>
          </li>
          <li>
            
             @if(!$slang)
              @if($lang->id == 2)
              <a href="{{ route('front.page',['slug' => $page->slug_ar , 'lang' => $sign ]) }}">
             {{ $page->title_ar }}
              @else 
              <a href="{{ route('front.page',['slug' => $page->slug , 'lang' => $sign ] ) }}">
              {{ $page->title }}
              @endif 
          @else  
              @if($slang == 2) 
              <a href="{{ route('front.page',['slug' => $page->slug_ar , 'lang' => $sign ]) }}">
              {{ $page->title_ar }}
              @else
              <a href="{{ route('front.page',['slug' => $page->slug , 'lang' => $sign ]) }}">
              {{ $page->title }}
              @endif
          @endif 
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Area End -->



<section class="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="about-info">
            <h4 class="title">   @if(!$slang)
              @if($lang->id == 2)
             {{ $page->title_ar }}
              @else 
              {{ $page->title }}
              @endif 
          @else  
              @if($slang == 2) 
              {{ $page->title_ar }}
              @else
              {{ $page->title }}
              @endif
          @endif 
              
            </h4>
            <p>@if(!$slang)
              @if($lang->id == 2)
            {!! $page->details_ar !!}
              @else 
              {!! $page->details !!}
              @endif 
          @else  
              @if($slang == 2) 
              {!! $page->details_ar !!}
              @else
               {!! $page->details !!}
              @endif
          @endif 
             
            </p>

          </div>
        </div>
      </div>
    </div>
  </section>

@endsection