@extends('layouts.front')
@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();


@endphp



@section('gsearch')


    
     <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "NewsArticle",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{url('/item',$blog->slug)}}"
      },
      "headline": "{{$blog->title}}",
      "image":"{{filter_var($blog->photo, FILTER_VALIDATE_URL) ?$blog->photo:asset('assets/images/blogs/'.$blog->photo)}}",
        
       
      "datePublished": "{{$blog->created_at}}",
      "views" :  "{{$blog->views}}",
      "category" : "{{$blog->category->name}}",
      "author": {
        "@type": "Person",
        "name": "{{$blog->author}}"
      }
      
    }
    </script>
    
    

@stop

@section('styles')
 <title>Almuslhi</title>
@endsection
@section('content')


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
              <a href="{{ route('front.blog',$sign) }}">
                {{ $langg->lang18 }}
              </a>
            </li>
            <li>
              <a href="{{ route('front.blogshow',['id' => $blog->id ,'lang' => $sign ]) }}">
                {{ $langg->lang39 }}
              </a>
            </li>
          </ul>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Area End -->



  <!-- Blog Details Area Start -->
  <section class="blog-details" id="blog-details">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="blog-content">
            <div class="feature-image">
              <img class="img-fluid" src="{{ asset('assets/images/blogs/'.$blog->photo) }}" 
               @if(!$slang)
                                      @if($lang->id == 2)
                                       
                                      alt="{{$blog->alt_ar}}"        
                                      @else 
                                       alt="{{$blog->alt}}"    
                                      @endif 
                                      @else  
                                      @if($slang == 2) 
                                          alt="{{$blog->alt_ar}}"    
                                      @else
                                           alt="{{$blog->alt}}"    
                                      @endif
                           @endif
                           
                           
              
              
              >
            </div>
            <div class="content">
                <h3 class="title">
                     @if(!$slang)
                                                      @if($lang->id == 2)
                                                      {{ $blog->title_ar }}
                                                      @else 
                                                      {{ $blog->title }}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      {{ $blog->title_ar }}
                                                      @else
                                                      {{ $blog->title }}
                                                      @endif
                                                  @endif  
                  </h3>
                  <ul class="post-meta">
                    <li>
                      <a href="javascript:;">
                        <i class="icofont-calendar"></i>
                        {{ date('d M, Y',strtotime($blog->created_at)) }}
                      </a>
                    </li>
                    <li>
                      <a href="javascript:;">
                          <i class="icofont-eye"></i>
                        {{ $blog->views }} {{ $langg->lang40 }}
                      </a>
                    </li>
                    <li>
                      <a href="javascript:;">
                        <i class="icofont-speech-comments"></i>
                        {{ $langg->lang41 }} : {{ $blog->source }}
                      </a>
                    </li>
                  </ul>
  @if(!$slang)
                                                      @if($lang->id == 2)
                                                      {!! $blog->details_ar !!}
                                                      @else 
                                                      {!! $blog->details !!}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                     {!! $blog->details_ar !!}
                                                      @else
                                                      {!! $blog->details !!}
                                                      @endif
                                                  @endif 
                  

                  <div class="tag-social-link">
                    <div class="tag">
                      <h6 class="title">Tag : </h6>
                      @foreach(explode(',', $blog->tags) as $key => $tag)
                        <a href="{{ route('front.blogtags',['slug' => $tag ,'lang' => $sign ]) }}">
                        {{ $tag }}{{ $key != count(explode(',', $blog->tags)) - 1  ? ',':''}}
                        </a>
                      @endforeach
                    </div>

                    <div class="social-sharing a2a_kit a2a_kit_size_32">
                    <ul class="social-links">
                      <li>
                        <a class="facebook a2a_button_facebook" href="">
                          <i class="fab fa-facebook-f"></i>
                        </a>
                      </li>
                        <li>
                            <a class="twitter a2a_button_twitter" href="">
                              <i class="fab fa-twitter"></i>
                            </a>
                          
                        </li>
                        <li>
                            <a class="linkedin a2a_button_linkedin" href="">
                              <i class="fab fa-linkedin-in"></i>
                            </a>

                        </li>
                        <li>
                          
                        <a class="a2a_dd plus" href="https://www.addtoany.com/share">
                            <i class="fas fa-plus"></i>
                          </a>
                        </li>
                      
                    </ul>
                    </div>
                    <script async src="https://static.addtoany.com/menu/page.js"></script>
                  </div>
            </div>
          </div>


    {{-- DISQUS START --}}   
    @if($gs->is_disqus == 1)
      <div class="comments">
           {!! $gs->disqus !!}
      </div>
    @endif
    {{-- DISQUS ENDS --}}

      </div>

        <div class="col-lg-4">
          <div class="blog-aside">
            <div class="serch-form">
              <form action="{{ route('front.blogsearch',$sign) }}">
                <input type="text" name="search" placeholder="{{ $langg->lang46 }}" required="">
                <button type="submit"><i class="icofont-search"></i></button>
              </form>
            </div>
            <div class="categori">
              <h4 class="title">{{ $langg->lang42 }}</h4>
              <span class="separator"></span>
              <ul class="categori-list">
                @foreach($bcats as $cat)
                <li>
                  <a href="{{ route('front.blogcategory',['slug' => $cat->slug ,'lang' => $sign ]) }}"  {!! $cat->id == $blog->category_id ? 'class="active"':'' !!}>
                    <span>  @if(!$slang)
                                                      @if($lang->id == 2)
                                                      {{ $cat->name_ar }}
                                                      @else 
                                                      {{ $cat->name }}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      {{ $cat->name_ar }}
                                                      @else
                                                      {{ $cat->name }}
                                                      @endif
                                                  @endif </span>
                    <span>({{ $cat->blogs()->count() }})</span>
                  </a>
                </li>
                @endforeach

              </ul>
            </div>
            <div class="recent-post-widget">
              <h4 class="title">{{ $langg->lang43 }}</h4>
              <span class="separator"></span>
              <ul class="post-list">

                @foreach (App\Models\Blog::orderBy('created_at', 'desc')->limit(4)->get() as $blog)
                <li>
                  <div class="post">
                    <div class="post-img">
                      <img style="width: 73px; height: 59px;" src="{{ asset('assets/images/blogs/'.$blog->photo) }}" 
                      
                       @if(!$slang)
                                      @if($lang->id == 2)
                                       
                                      alt="{{$blog->alt_ar}}"        
                                      @else 
                                       alt="{{$blog->alt}}"    
                                      @endif 
                                      @else  
                                      @if($slang == 2) 
                                          alt="{{$blog->alt_ar}}"    
                                      @else
                                           alt="{{$blog->alt}}"    
                                      @endif
                           @endif
                           
                      >
                    </div>
                    <div class="post-details">
                      <a href="{{ route('front.blogshow',['id' => $blog->id ,'lang' => $sign ]) }}">
                          <h4 class="post-title">
                                @if(!$slang)
                                                      @if($lang->id == 2)
                                                      {{strlen($blog->title_ar) > 45 ? substr($blog->title_ar,0,45)." .." : $blog->title_ar}}
                                                      @else 
                                                      {{strlen($blog->title) > 45 ? substr($blog->title,0,45)." .." : $blog->title}}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                     {{strlen($blog->title_ar) > 45 ? substr($blog->title_ar,0,45)." .." : $blog->title_ar}}
                                                      @else
                                                      {{strlen($blog->title) > 45 ? substr($blog->title,0,45)." .." : $blog->title}}
                                                      @endif
                                                  @endif 
                              
                          </h4>
                      </a>
                      <p class="date">
                          {{ date('M d - Y',(strtotime($blog->created_at))) }}
                      </p>
                    </div>
                  </div>
                </li>
                @endforeach


              </ul>
            </div>
            <div class="archives">
              <h4 class="title">{{ $langg->lang44 }}</h4>
              <span class="separator"></span>
              <ul class="archives-list">
                @foreach($archives as $key => $archive)
                <li>
                  <a href="{{ route('front.blogarchive',['slug' => $key ,'lang' => $sign ]) }}">
                    <span>{{ $key }}</span>
                    <span>({{ count($archive) }})</span>
                  </a>
                </li>
                @endforeach
              </ul>
            </div>
            <div class="tags">
              <h4 class="title">{{ $langg->lang45 }}</h4>
              <span class="separator"></span>
              <ul class="tags-list">
                @foreach($tags as $tag)
                  @if(!empty($tag))
                  <li>
                    <a href="{{ route('front.blogtags',['slug' => $tag ,'lang' => $sign ]) }}">{{ $tag }} </a>
                  </li>
                  @endif
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Blog Details Area End-->


@endsection
