@extends('layouts.front_34')
@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();

@endphp

@section('content')

  <!-- Blog Page Area Start -->
  <section class="blogpagearea">
    <div class="container">
      <div id="ajaxContent">

      <div class="row">

        @foreach($blogs as $blogg)
        <div class="col-md-6 col-lg-4 mb-3">
              <div class="blog-box">
                <div class="blog-images">
                    <div class="img">
                    <img src="{{ $blogg->photo ? asset('assets/images/blogs/'.$blogg->photo):asset('assets/images/noimage.png') }}" class="img-fluid" 
                    
                     @if(!$slang)
                                      @if($lang->id == 2)
                                       
                                      alt="{{$blogg->alt_ar}}"        
                                      @else 
                                       alt="{{$blogg->alt}}"    
                                      @endif 
                                      @else  
                                      @if($slang == 2) 
                                          alt="{{$blogg->alt_ar}}"    
                                      @else
                                           alt="{{$blogg->alt}}"    
                                      @endif
                           @endif
                           
                           
                    
                    >
                    </div>
                </div>
                <div class="details">
                    
                    <div class="blog-date">
                      <div class="box">
                        <p class="my-2"> <i class="fas fa-calendar-alt"></i> {{date('d', strtotime($blogg->created_at))}} / {{date('M', strtotime($blogg->created_at))}}</p>
                      </div>
                    </div>
                    <a href="{{route('front.blogshow',['id' => $blogg->id ,'lang' => $sign ])}}">
                      <h4 class="blog-title">
                        @if(!$slang)
                                                      @if($lang->id == 2)
                                                      {{strlen($blogg->title_ar) > 50 ? substr($blogg->title_ar,0,50)."...":$blogg->title_ar}}
                                                      @else 
                                                      {{strlen($blogg->title) > 50 ? substr($blogg->title,0,50)."...":$blogg->title}}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      {{strlen($blogg->title_ar) > 50 ? substr($blogg->title_ar,0,50)."...":$blogg->title_ar}}
                                                      @else
                                                      {{strlen($blogg->title) > 50 ? substr($blogg->title,0,50)."...":$blogg->title}}
                                                      @endif
                                                  @endif 
                      </h4>
                    </a>
                  <p class="blog-text">
                   @if(!$slang)
                                                      @if($lang->id == 2)
                                                     {{substr(strip_tags($blogg->details_ar),0,120)}}
                                                      @else 
                                                      {{substr(strip_tags($blogg->details),0,120)}}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      {{substr(strip_tags($blogg->details_ar),0,120)}}
                                                      @else
                                                      {{substr(strip_tags($blogg->details),0,120)}}
                                                      @endif
                                                  @endif  
                  </p>
                  <a class="read-more-btn" href="{{route('front.blogshow',['id' => $blogg->id ,'lang' => $sign ])}}">{{ $langg->lang38 }} <i class="fas fa-angle-right"></i></a>
                </div>
            </div>
        </div>


        @endforeach

      </div>

        <div class="page-center">
          {!! $blogs->links() !!}               
        </div>
</div>

    </div>
  </section>
  <!-- Blog Page Area Start -->


@endsection