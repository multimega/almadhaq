@extends('layouts.front')



@section('gsearch')
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
         @foreach($faqs as $k=>$fq)  
          {
        "@type": "Question",
        "name": "{{ $fq->title }}",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "{{ $fq->details }}"
        }
      }@if(count($faqs)-1 != $k), @endif
      @endforeach
      ]
    }
    </script>
@stop

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
              {{ $langg->lang17 }}
            </a>
          </li>
          <li>
            <a href="{{ route('front.faq',$sign) }}">
              {{ $langg->lang19 }}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Area End -->



  <!-- faq Area Start -->
  <section class="faq-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
          <div id="accordion">

            @foreach($faqs as $fq)
            <h3 class="heading"> 
            @if(!$slang)
            @if($lang->id == 2)
             {{ $fq->title_ar }}
              @else 
              {{ $fq->title }}
              @endif 
          @else  
              @if($slang == 2) 
              {{ $fq->title_ar }}
              @else
              {{ $fq->title }}
              @endif
          @endif</h3>
            <div class="content">
                <p>@if(!$slang)
                     @if($lang->id == 2)
             {!! $fq->details_ar !!}
              @else 
              {!! $fq->details !!}
              @endif 
          @else  
              @if($slang == 2) 
              {!! $fq->details_ar !!}
              @else
              {!! $fq->details !!}
              @endif
          @endif</p>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- faq Area End-->

@endsection