
@php 

      
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
$categorys=App\Models\Category::get();


$main=App\Models\Generalsetting::find(1);

$chunk= App\Models\Service::get()->take(4);
$chunkss= App\Models\Service::orderby('id','desc')->get()->take(3);

@endphp


        <main class="main">
            <div class="home-slider owl-carousel">
                @if($ps->slider == 1)
				   @if(count($sliders))
					@foreach($sliders as $data)
                <div class="home-slide">
                    <div class="slide-bg owl-lazy"  data-src="{{('assets/images/sliders/'.$data->photo)}}"></div><!-- End .slide-bg -->
                    <div class="home-slide-content">
                        <h1>@if(!$slang)
                                                @if($lang->id == 2)
                                                     {{$data->title_text_ar}}
                                                @else 
                                                      {{$data->title_text}}
                                                @endif 
                                            @else  
                                                @if($slang == 2) 
                                                    {{$data->title_text_ar}}
                                                @else
                                                    {{$data->title_text}}
                                                @endif
                                          @endif</h1>
                        <h3>@if(!$slang)
                                                @if($lang->id == 2)
                                                     {{$data->subtitle_text}}
                                                @else 
                                                      {{$data->subtitle_text}}
                                                @endif 
                                            @else  
                                                @if($slang == 2) 
                                                    {{$data->subtitle_text}}
                                                @else
                                                    {{$data->subtitle_text}}
                                                @endif
                                          @endif</h3>

                        <a href="{{$data->link}}" class="btn btn-link" role="button">{{ $langg->lang25 }}</a>
                    </div><!-- End .home-slide-content -->
                </div><!-- End .home-slide -->

                @endforeach
                @endif
                @endif
            </div><!-- End .home-slider -->
        </main><!-- End .main -->
    