@extends('layouts.front')

@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();

@endphp
<title>Almuslhi</title>
@section('content')


  <!-- Breadcrumb Area Start -->
  <div class="breadcrumb-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <ul class="pages">

          {{-- Category Breadcumbs --}}

          @if(isset($bcat))
                
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
                <a href="{{ route('front.blogcategory',['slug' => $bcat->slug , 'lang' => $sign ]) }}">
                  @if(!$slang)
                                                      @if($lang->id == 2)
                                                      {{ $bcat->name_ar }}
                                                      @else 
                                                      {{ $bcat->name }}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      {{ $bcat->name_ar }}
                                                      @else
                                                      {{ $bcat->name }}
                                                      @endif
                                                  @endif 
                </a>
              </li>

          @elseif(isset($slug))

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
                <a href="{{ route('front.blogtags',['slug' => $slug , 'lang' => $sign ]) }}">
                  {{ $langg->lang35 }}: {{ $slug }}
                </a>
              </li>

          @elseif(isset($search))
                
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
                <a href="Javascript:;">
                  {{ $langg->lang36 }}
                </a>
              </li>
              <li>
                <a href="Javascript:;">
                  {{ $search }}
                </a>
              </li>

          @elseif(isset($date))
                
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
                <a href="Javascript:;">
                  {{ $langg->lang37 }}: {{ date('F Y',strtotime($date)) }}
                </a>
              </li>

          @else
                
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
          @endif

          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb Area End -->
 <section class="blog-details blogpagearea" id="blog-details">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
           @foreach($blogs as $blog)
          <div class="blog-content blog-box ">
            <div class="feature-image blog-images">
               <div class="img">
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
              <div class="date d-flex justify-content-center">
                      <div class="box align-self-center">
                        <p>{{date('d', strtotime($blog->created_at))}}</p>
                        <p>{{date('M', strtotime($blog->created_at))}}</p>
                      </div>
                    </div>
              </div>
            </div>
            <div class="content details">
                <h3 class="title">
                    <a href="{{ route('front.blogshow',['id' => $blog->id ,'lang' => $sign ]) }}">
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
                                                  </a>
                  </h3>
                  <p class="blog-text">
                   @if(!$slang)
                                                      @if($lang->id == 2)
                                                     {{substr(strip_tags($blog->details_ar),0,120)}}
                                                      @else 
                                                      {{substr(strip_tags($blog->details),0,120)}}
                                                      @endif 
                                                  @else  
                                                      @if($slang == 2) 
                                                      {{substr(strip_tags($blog->details_ar),0,120)}}
                                                      @else
                                                      {{substr(strip_tags($blog->details),0,120)}}
                                                      @endif
                                                  @endif  
                  </p>
                  <a class="read-more-btn" href="{{ route('front.blogshow',['id' => $blog->id ,'lang' => $sign ]) }}">{{ $langg->lang38 }}</a>

            </div>
          </div>


    {{-- DISQUS START --}}   
    @if($gs->is_disqus == 1)
      <div class="comments">
           {!! $gs->disqus !!}
      </div>
    @endif
    {{-- DISQUS ENDS --}}

        @endforeach
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
  <!-- Blog Page Area Start -->
<!--  <section class="blogpagearea">-->
<!--    <div class="container">-->
<!--      <div id="ajaxContent">-->
         
  <!--          <section class="blog-details" id="blog-details">-->
  <!--  <div class="container">-->
  <!--    <div class="row">-->
  <!--       @foreach($blogs as $blog)-->
  <!--      <div class="col-lg-8">-->
  <!--        <div class="blog-content">-->
  <!--          <div class="feature-image">-->
  <!--            <img class="img-fluid" src="{{ asset('assets/images/blogs/'.$blog->photo) }}" -->
  <!--             @if(!$slang)-->
  <!--                                    @if($lang->id == 2)-->
                                       
  <!--                                    alt="{{$blog->alt_ar}}"        -->
  <!--                                    @else -->
  <!--                                     alt="{{$blog->alt}}"    -->
  <!--                                    @endif -->
  <!--                                    @else  -->
  <!--                                    @if($slang == 2) -->
  <!--                                        alt="{{$blog->alt_ar}}"    -->
  <!--                                    @else-->
  <!--                                         alt="{{$blog->alt}}"    -->
  <!--                                    @endif-->
  <!--                         @endif-->
                           
                           
              
              
  <!--            >-->
  <!--          </div>-->
  <!--          <div class="content">-->
  <!--              <h3 class="title">-->
  <!--                   @if(!$slang)-->
  <!--                                                    @if($lang->id == 2)-->
  <!--                                                    {{ $blog->title_ar }}-->
  <!--                                                    @else -->
  <!--                                                    {{ $blog->title }}-->
  <!--                                                    @endif -->
  <!--                                                @else  -->
  <!--                                                    @if($slang == 2) -->
  <!--                                                    {{ $blog->title_ar }}-->
  <!--                                                    @else-->
  <!--                                                    {{ $blog->title }}-->
  <!--                                                    @endif-->
  <!--                                                @endif  -->
  <!--                </h3>-->
  <!--                <ul class="post-meta">-->
  <!--                  <li>-->
  <!--                    <a href="javascript:;">-->
  <!--                      <i class="icofont-calendar"></i>-->
  <!--                      {{ date('d M, Y',strtotime($blog->created_at)) }}-->
  <!--                    </a>-->
  <!--                  </li>-->
  <!--                  <li>-->
  <!--                    <a href="javascript:;">-->
  <!--                        <i class="icofont-eye"></i>-->
  <!--                      {{ $blog->views }} {{ $langg->lang40 }}-->
  <!--                    </a>-->
  <!--                  </li>-->
  <!--                  <li>-->
  <!--                    <a href="javascript:;">-->
  <!--                      <i class="icofont-speech-comments"></i>-->
  <!--                      {{ $langg->lang41 }} : {{ $blog->source }}-->
  <!--                    </a>-->
  <!--                  </li>-->
  <!--                </ul>-->
  <!--@if(!$slang)-->
  <!--                                                    @if($lang->id == 2)-->
  <!--                                                    {!! $blog->details_ar !!}-->
  <!--                                                    @else -->
  <!--                                                    {!! $blog->details !!}-->
  <!--                                                    @endif -->
  <!--                                                @else  -->
  <!--                                                    @if($slang == 2) -->
  <!--                                                   {!! $blog->details_ar !!}-->
  <!--                                                    @else-->
  <!--                                                    {!! $blog->details !!}-->
  <!--                                                    @endif-->
  <!--                                                @endif -->
                  

  <!--                <div class="tag-social-link">-->
  <!--                  <div class="tag">-->
  <!--                    <h6 class="title">Tag : </h6>-->
  <!--                    @foreach(explode(',', $blog->tags) as $key => $tag)-->
  <!--                      <a href="{{ route('front.blogtags',['slug' => $tag ,'lang' => $sign ]) }}">-->
  <!--                      {{ $tag }}{{ $key != count(explode(',', $blog->tags)) - 1  ? ',':''}}-->
  <!--                      </a>-->
  <!--                    @endforeach-->
  <!--                  </div>-->

  <!--                  <div class="social-sharing a2a_kit a2a_kit_size_32">-->
  <!--                  <ul class="social-links">-->
  <!--                    <li>-->
  <!--                      <a class="facebook a2a_button_facebook" href="">-->
  <!--                        <i class="fab fa-facebook-f"></i>-->
  <!--                      </a>-->
  <!--                    </li>-->
  <!--                      <li>-->
  <!--                          <a class="twitter a2a_button_twitter" href="">-->
  <!--                            <i class="fab fa-twitter"></i>-->
  <!--                          </a>-->
                          
  <!--                      </li>-->
  <!--                      <li>-->
  <!--                          <a class="linkedin a2a_button_linkedin" href="">-->
  <!--                            <i class="fab fa-linkedin-in"></i>-->
  <!--                          </a>-->

  <!--                      </li>-->
  <!--                      <li>-->
                          
  <!--                      <a class="a2a_dd plus" href="https://www.addtoany.com/share">-->
  <!--                          <i class="fas fa-plus"></i>-->
  <!--                        </a>-->
  <!--                      </li>-->
                      
  <!--                  </ul>-->
  <!--                  </div>-->
  <!--                  <script async src="https://static.addtoany.com/menu/page.js"></script>-->
  <!--                </div>-->
  <!--          </div>-->
  <!--        </div>-->


  <!--  {{-- DISQUS START --}}   -->
  <!--  @if($gs->is_disqus == 1)-->
  <!--    <div class="comments">-->
  <!--         {!! $gs->disqus !!}-->
  <!--    </div>-->
  <!--  @endif-->
  <!--  {{-- DISQUS ENDS --}}-->

  <!--    </div>-->
  <!--      @endforeach-->
  <!--      <div class="col-lg-4">-->
  <!--        <div class="blog-aside">-->
  <!--          <div class="serch-form">-->
  <!--            <form action="{{ route('front.blogsearch',$sign) }}">-->
  <!--              <input type="text" name="search" placeholder="{{ $langg->lang46 }}" required="">-->
  <!--              <button type="submit"><i class="icofont-search"></i></button>-->
  <!--            </form>-->
  <!--          </div>-->
  <!--          <div class="categori">-->
  <!--            <h4 class="title">{{ $langg->lang42 }}</h4>-->
  <!--            <span class="separator"></span>-->
  <!--            <ul class="categori-list">-->
  <!--              @foreach($bcats as $cat)-->
  <!--              <li>-->
  <!--                  <span>  @if(!$slang)-->
  <!--                                                    @if($lang->id == 2)-->
  <!--                                                    {{ $cat->name_ar }}-->
  <!--                                                    @else -->
  <!--                                                    {{ $cat->name }}-->
  <!--                                                    @endif -->
  <!--                                                @else  -->
  <!--                                                    @if($slang == 2) -->
  <!--                                                    {{ $cat->name_ar }}-->
  <!--                                                    @else-->
  <!--                                                    {{ $cat->name }}-->
  <!--                                                    @endif-->
  <!--                                                @endif </span>-->
  <!--                  <span>({{ $cat->blogs()->count() }})</span>-->
  <!--                </a>-->
  <!--              </li>-->
  <!--              @endforeach-->

  <!--            </ul>-->
  <!--          </div>-->
  <!--          <div class="recent-post-widget">-->
  <!--            <h4 class="title">{{ $langg->lang43 }}</h4>-->
  <!--            <span class="separator"></span>-->
  <!--            <ul class="post-list">-->

  <!--              @foreach (App\Models\Blog::orderBy('created_at', 'desc')->limit(4)->get() as $blog)-->
  <!--              <li>-->
  <!--                <div class="post">-->
  <!--                  <div class="post-img">-->
  <!--                    <img style="width: 73px; height: 59px;" src="{{ asset('assets/images/blogs/'.$blog->photo) }}" -->
                      
  <!--                     @if(!$slang)-->
  <!--                                    @if($lang->id == 2)-->
                                       
  <!--                                    alt="{{$blog->alt_ar}}"        -->
  <!--                                    @else -->
  <!--                                     alt="{{$blog->alt}}"    -->
  <!--                                    @endif -->
  <!--                                    @else  -->
  <!--                                    @if($slang == 2) -->
  <!--                                        alt="{{$blog->alt_ar}}"    -->
  <!--                                    @else-->
  <!--                                         alt="{{$blog->alt}}"    -->
  <!--                                    @endif-->
  <!--                         @endif-->
                           
  <!--                    >-->
  <!--                  </div>-->
  <!--                  <div class="post-details">-->
  <!--                    <a href="{{ route('front.blogshow',['id' => $blog->id ,'lang' => $sign ]) }}">-->
  <!--                        <h4 class="post-title">-->
  <!--                              @if(!$slang)-->
  <!--                                                    @if($lang->id == 2)-->
  <!--                                                    {{strlen($blog->title_ar) > 45 ? substr($blog->title_ar,0,45)." .." : $blog->title_ar}}-->
  <!--                                                    @else -->
  <!--                                                    {{strlen($blog->title) > 45 ? substr($blog->title,0,45)." .." : $blog->title}}-->
  <!--                                                    @endif -->
  <!--                                                @else  -->
  <!--                                                    @if($slang == 2) -->
  <!--                                                   {{strlen($blog->title_ar) > 45 ? substr($blog->title_ar,0,45)." .." : $blog->title_ar}}-->
  <!--                                                    @else-->
  <!--                                                    {{strlen($blog->title) > 45 ? substr($blog->title,0,45)." .." : $blog->title}}-->
  <!--                                                    @endif-->
  <!--                                                @endif -->
                              
  <!--                        </h4>-->
  <!--                    </a>-->
  <!--                    <p class="date">-->
  <!--                        {{ date('M d - Y',(strtotime($blog->created_at))) }}-->
  <!--                    </p>-->
  <!--                  </div>-->
  <!--                </div>-->
  <!--              </li>-->
  <!--              @endforeach-->


  <!--            </ul>-->
  <!--          </div>-->
  <!--          <div class="archives">-->
  <!--            <h4 class="title">{{ $langg->lang44 }}</h4>-->
  <!--            <span class="separator"></span>-->
  <!--            <ul class="archives-list">-->
  <!--              @foreach($archives as $key => $archive)-->
  <!--              <li>-->
  <!--                <a href="{{ route('front.blogarchive',['slug' => $key ,'lang' => $sign ]) }}">-->
  <!--                  <span>{{ $key }}</span>-->
  <!--                  <span>({{ count($archive) }})</span>-->
  <!--                </a>-->
  <!--              </li>-->
  <!--              @endforeach-->
  <!--            </ul>-->
  <!--          </div>-->
  <!--          <div class="tags">-->
  <!--            <h4 class="title">{{ $langg->lang45 }}</h4>-->
  <!--            <span class="separator"></span>-->
  <!--            <ul class="tags-list">-->
  <!--              @foreach($tags as $tag)-->
  <!--                @if(!empty($tag))-->
  <!--                <li>-->
  <!--                  <a href="{{ route('front.blogtags',['slug' => $tag ,'lang' => $sign ]) }}">{{ $tag }} </a>-->
  <!--                </li>-->
  <!--                @endif-->
  <!--              @endforeach-->
  <!--            </ul>-->
  <!--          </div>-->
  <!--        </div>-->
  <!--      </div>-->
  <!--    </div>-->
  <!--  </div>-->
  <!--</section>-->
         

<!--      <div class="row ">-->

<!--         @foreach($blogs as $blog)-->
<!--        <div class="col-lg-8">-->
<!--          <div class="blog-content">-->
<!--            <div class="feature-image">-->
<!--              <img class="img-fluid" src="{{ asset('assets/images/blogs/'.$blog->photo) }}" -->
<!--               @if(!$slang)-->
<!--                                      @if($lang->id == 2)-->
                                       
<!--                                      alt="{{$blog->alt_ar}}"        -->
<!--                                      @else -->
<!--                                       alt="{{$blog->alt}}"    -->
<!--                                      @endif -->
<!--                                      @else  -->
<!--                                      @if($slang == 2) -->
<!--                                          alt="{{$blog->alt_ar}}"    -->
<!--                                      @else-->
<!--                                           alt="{{$blog->alt}}"    -->
<!--                                      @endif-->
<!--                           @endif-->
                           
                           
              
              
<!--              >-->
<!--            </div>-->
<!--            <div class="content">-->
<!--                <h3 class="title">-->
<!--                     @if(!$slang)-->
<!--                                                      @if($lang->id == 2)-->
<!--                                                      {{ $blog->title_ar }}-->
<!--                                                      @else -->
<!--                                                      {{ $blog->title }}-->
<!--                                                      @endif -->
<!--                                                  @else  -->
<!--                                                      @if($slang == 2) -->
<!--                                                      {{ $blog->title_ar }}-->
<!--                                                      @else-->
<!--                                                      {{ $blog->title }}-->
<!--                                                      @endif-->
<!--                                                  @endif  -->
<!--                  </h3>-->
<!--                  <ul class="post-meta">-->
<!--                    <li>-->
<!--                      <a href="javascript:;">-->
<!--                        <i class="icofont-calendar"></i>-->
<!--                        {{ date('d M, Y',strtotime($blog->created_at)) }}-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                      <a href="javascript:;">-->
<!--                          <i class="icofont-eye"></i>-->
<!--                        {{ $blog->views }} {{ $langg->lang40 }}-->
<!--                      </a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                      <a href="javascript:;">-->
<!--                        <i class="icofont-speech-comments"></i>-->
<!--                        {{ $langg->lang41 }} : {{ $blog->source }}-->
<!--                      </a>-->
<!--                    </li>-->
<!--                  </ul>-->
<!--  @if(!$slang)-->
<!--                                                      @if($lang->id == 2)-->
<!--                                                      {!! $blog->details_ar !!}-->
<!--                                                      @else -->
<!--                                                      {!! $blog->details !!}-->
<!--                                                      @endif -->
<!--                                                  @else  -->
<!--                                                      @if($slang == 2) -->
<!--                                                     {!! $blog->details_ar !!}-->
<!--                                                      @else-->
<!--                                                      {!! $blog->details !!}-->
<!--                                                      @endif-->
<!--                                                  @endif -->
                  

<!--                  <div class="tag-social-link">-->
<!--                    <div class="tag">-->
<!--                      <h6 class="title">Tag : </h6>-->
<!--                      @foreach(explode(',', $blog->tags) as $key => $tag)-->
<!--                        <a href="{{ route('front.blogtags',['slug' => $tag ,'lang' => $sign ]) }}">-->
<!--                        {{ $tag }}{{ $key != count(explode(',', $blog->tags)) - 1  ? ',':''}}-->
<!--                        </a>-->
<!--                      @endforeach-->
<!--                    </div>-->

<!--                    <div class="social-sharing a2a_kit a2a_kit_size_32">-->
<!--                    <ul class="social-links">-->
<!--                      <li>-->
<!--                        <a class="facebook a2a_button_facebook" href="">-->
<!--                          <i class="fab fa-facebook-f"></i>-->
<!--                        </a>-->
<!--                      </li>-->
<!--                        <li>-->
<!--                            <a class="twitter a2a_button_twitter" href="">-->
<!--                              <i class="fab fa-twitter"></i>-->
<!--                            </a>-->
                          
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a class="linkedin a2a_button_linkedin" href="">-->
<!--                              <i class="fab fa-linkedin-in"></i>-->
<!--                            </a>-->

<!--                        </li>-->
<!--                        <li>-->
                          
<!--                        <a class="a2a_dd plus" href="https://www.addtoany.com/share">-->
<!--                            <i class="fas fa-plus"></i>-->
<!--                          </a>-->
<!--                        </li>-->
                      
<!--                    </ul>-->
<!--                    </div>-->
<!--                    <script async src="https://static.addtoany.com/menu/page.js"></script>-->
<!--                  </div>-->
<!--            </div>-->
<!--          </div>-->


<!--    {{-- DISQUS START --}}   -->
<!--    @if($gs->is_disqus == 1)-->
<!--      <div class="comments">-->
<!--           {!! $gs->disqus !!}-->
<!--      </div>-->
<!--    @endif-->
<!--    {{-- DISQUS ENDS --}}-->

<!--      </div>-->
<!--        @endforeach-->
<!--        <div class="col-lg-4">-->
<!--          <div class="blog-aside">-->
<!--            <div class="serch-form">-->
<!--              <form action="{{ route('front.blogsearch',$sign) }}">-->
<!--                <input type="text" name="search" placeholder="{{ $langg->lang46 }}" required="">-->
<!--                <button type="submit"><i class="icofont-search"></i></button>-->
<!--              </form>-->
<!--            </div>-->
<!--            <div class="categori">-->
<!--              <h4 class="title">{{ $langg->lang42 }}</h4>-->
<!--              <span class="separator"></span>-->
<!--              <ul class="categori-list">-->
<!--                @foreach($bcats as $cat)-->
<!--                <li>-->
<!--                    <span>  @if(!$slang)-->
<!--                                                      @if($lang->id == 2)-->
<!--                                                      {{ $cat->name_ar }}-->
<!--                                                      @else -->
<!--                                                      {{ $cat->name }}-->
<!--                                                      @endif -->
<!--                                                  @else  -->
<!--                                                      @if($slang == 2) -->
<!--                                                      {{ $cat->name_ar }}-->
<!--                                                      @else-->
<!--                                                      {{ $cat->name }}-->
<!--                                                      @endif-->
<!--                                                  @endif </span>-->
<!--                    <span>({{ $cat->blogs()->count() }})</span>-->
<!--                  </a>-->
<!--                </li>-->
<!--                @endforeach-->

<!--              </ul>-->
<!--            </div>-->
<!--            <div class="recent-post-widget">-->
<!--              <h4 class="title">{{ $langg->lang43 }}</h4>-->
<!--              <span class="separator"></span>-->
<!--              <ul class="post-list">-->

<!--                @foreach (App\Models\Blog::orderBy('created_at', 'desc')->limit(4)->get() as $blog)-->
<!--                <li>-->
<!--                  <div class="post">-->
<!--                    <div class="post-img">-->
<!--                      <img style="width: 73px; height: 59px;" src="{{ asset('assets/images/blogs/'.$blog->photo) }}" -->
                      
<!--                       @if(!$slang)-->
<!--                                      @if($lang->id == 2)-->
                                       
<!--                                      alt="{{$blog->alt_ar}}"        -->
<!--                                      @else -->
<!--                                       alt="{{$blog->alt}}"    -->
<!--                                      @endif -->
<!--                                      @else  -->
<!--                                      @if($slang == 2) -->
<!--                                          alt="{{$blog->alt_ar}}"    -->
<!--                                      @else-->
<!--                                           alt="{{$blog->alt}}"    -->
<!--                                      @endif-->
<!--                           @endif-->
                           
<!--                      >-->
<!--                    </div>-->
<!--                    <div class="post-details">-->
<!--                      <a href="{{ route('front.blogshow',['id' => $blog->id ,'lang' => $sign ]) }}">-->
<!--                          <h4 class="post-title">-->
<!--                                @if(!$slang)-->
<!--                                                      @if($lang->id == 2)-->
<!--                                                      {{strlen($blog->title_ar) > 45 ? substr($blog->title_ar,0,45)." .." : $blog->title_ar}}-->
<!--                                                      @else -->
<!--                                                      {{strlen($blog->title) > 45 ? substr($blog->title,0,45)." .." : $blog->title}}-->
<!--                                                      @endif -->
<!--                                                  @else  -->
<!--                                                      @if($slang == 2) -->
<!--                                                     {{strlen($blog->title_ar) > 45 ? substr($blog->title_ar,0,45)." .." : $blog->title_ar}}-->
<!--                                                      @else-->
<!--                                                      {{strlen($blog->title) > 45 ? substr($blog->title,0,45)." .." : $blog->title}}-->
<!--                                                      @endif-->
<!--                                                  @endif -->
                              
<!--                          </h4>-->
<!--                      </a>-->
<!--                      <p class="date">-->
<!--                          {{ date('M d - Y',(strtotime($blog->created_at))) }}-->
<!--                      </p>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </li>-->
<!--                @endforeach-->


<!--              </ul>-->
<!--            </div>-->
<!--            <div class="archives">-->
<!--              <h4 class="title">{{ $langg->lang44 }}</h4>-->
<!--              <span class="separator"></span>-->
<!--              <ul class="archives-list">-->
<!--                @foreach($archives as $key => $archive)-->
<!--                <li>-->
<!--                  <a href="{{ route('front.blogarchive',['slug' => $key ,'lang' => $sign ]) }}">-->
<!--                    <span>{{ $key }}</span>-->
<!--                    <span>({{ count($archive) }})</span>-->
<!--                  </a>-->
<!--                </li>-->
<!--                @endforeach-->
<!--              </ul>-->
<!--            </div>-->
<!--            <div class="tags">-->
<!--              <h4 class="title">{{ $langg->lang45 }}</h4>-->
<!--              <span class="separator"></span>-->
<!--              <ul class="tags-list">-->
<!--                @foreach($tags as $tag)-->
<!--                  @if(!empty($tag))-->
<!--                  <li>-->
<!--                    <a href="{{ route('front.blogtags',['slug' => $tag ,'lang' => $sign ]) }}">{{ $tag }} </a>-->
<!--                  </li>-->
<!--                  @endif-->
<!--                @endforeach-->
<!--              </ul>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->

<!--        <div class="page-center">-->
<!--          {!! $blogs->links() !!}               -->
<!--        </div>-->
<!--</div>-->

<!--    </div>-->
<!--  </section>-->
  <!-- Blog Page Area Start -->




@endsection


@section('scripts')

<script type="text/javascript">
  

    // Pagination Starts

    $(document).on('click', '.pagination li', function (event) {
      event.preventDefault();
      if ($(this).find('a').attr('href') != '#' && $(this).find('a').attr('href')) {
        $('#preloader').show();
        $('#ajaxContent').load($(this).find('a').attr('href'), function (response, status, xhr) {
          if (status == "success") {
            $("html,body").animate({
              scrollTop: 0
            }, 1);
            $('#preloader').fadeOut();


          }

        });
      }
    });

    // Pagination Ends

</script>


@endsection