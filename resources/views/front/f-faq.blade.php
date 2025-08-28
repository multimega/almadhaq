@extends('layouts.front_34')



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
  <!-- faq Area Start -->
  <section class="faq-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div id="accordion">
                <?php $i=0 ?>
                @foreach($faqs as $fq)
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne{{$i}}" aria-expanded="true" aria-controls="collapseOne">
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
                          @endif
                        </button>
                      </h5>
                    </div>
                
                    <div id="collapseOne{{$i}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
                        @if(!$slang)
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
                      @endif
                      </div>
                    </div>
                  </div>
                  <?php $i++ ?>
                  @endforeach
            </div>
        </div>
      </div>
    </div>
  </section>
  <!-- faq Area End-->

@endsection