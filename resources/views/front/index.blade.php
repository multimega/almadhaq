
@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
   
 $features= App\Models\Feature::all();
$main=App\Models\Generalsetting::find(1);
 @endphp

@if($main->templatee_select ==11111)

@include('layouts.header_demo11111')

@endif
 
@if($main->templatee_select ==222)

@include('layouts.header_demo222')

@endif
 
 
@if($main->templatee_select ==3)

@include('layouts.header_demo3')

@endif



@if($main->templatee_select ==4)

@include('layouts.header1_dem')

@endif



@if($main->templatee_select == 19)

@include('layouts.header_demo19')

@endif



@if($main->templatee_select == 28)

@include('layouts.header_demo28')

@endif

@if($main->templatee_select == 27)

@include('layouts.header_demo27')

@endif


@if($main->templatee_select ==66)

@include('layouts.header_demo66')

@endif


@if($main->templatee_select ==11)

@include('layouts.header_demo11')

@endif

@if($main->templatee_select ==17)

@include('layouts.header_demo17')

@endif

@if($main->templatee_select ==22)

@include('layouts.header_demo22')

@endif

@if($main->templatee_select ==7)

@include('layouts.header_demo7')

@endif

@if($main->templatee_select ==16)

@include('layouts.header_demo16')

@endif
@if($main->templatee_select ==166)

@include('layouts.header_demo166')

@endif

@if($main->templatee_select ==9)

@include('layouts.header_demo9')

@endif


@if($main->templatee_select ==10)

@include('layouts.header_demo10')

@endif


@if($main->templatee_select ==15)

@include('layouts.header_demo15')

@endif

@if($main->templatee_select ==155)

@include('layouts.header_demo155')

@endif


@if($main->templatee_select ==1111)

@include('layouts.header_demo111')

@endif

@if($main->templatee_select ==14)

@include('layouts.header_demo14')

@endif

@if($main->templatee_select == 29)

@include('layouts.header_demo29')

@endif


@if($main->templatee_select == 30)

@include('layouts.header_demo30')

@endif

@if($main->templatee_select == 31)

@include('layouts.header_demo31')

@endif

@if($main->templatee_select == 32)

@include('layouts.header_demo32')

@endif

@if($main->templatee_select == 34)

@include('layouts.header_demo34')

@endif


@if($main->templatee_select == 11)

@include('layouts.header_demo1')

@endif



@if($main->templatee_select == 55)

@include('layouts.header_demo5')

@endif


@if($main->templatee_select == 5)

@include('layouts.header5_demo')

@endif



@if($main->templatee_select == 12)

@include('layouts.header_demo12')

@endif




@if($main->templatee_select == 13)

@include('layouts.header_demo13')

@endif



@if($main->templatee_select == 18)

@include('layouts.header_demo18')

@endif


@if($main->templatee_select == 2)

@include('layouts.header_demo2')

@endif



@if($main->templatee_select == 25)

@include('layouts.header25_dem')

@endif

@if($main->templatee_select == 26)

@include('layouts.header_demo26')

@endif



@if($main->templatee_select == 6)

@include('layouts.header_demo6')

@endif


@if($main->templatee_select == 8)

@include('layouts.header_demo8')

@endif



@if($main->templatee_select ==1)

@include('layouts.header')

@endif





@if($main->templatee_select == 1)
@dd(7878787)

	@if($ps->slider == 1)

		@if(count($sliders))

			@include('includes.slider-style')
		@endif
	@endif

	@if($ps->slider == 1)
		<!-- Hero Area Start -->
		<section class="hero-area">
			@if($ps->slider == 1)

				@if(count($sliders))
					<div class="hero-area-slider">
						<div class="slide-progress"></div>
						<div class="intro-carousel">
							@foreach($sliders as $data)
								@php
				$galss = str_replace(' ', '%20', $data->photo);
				@endphp
								<div class="intro-content {{$data->position}}" style="background-image: url({{asset('assets/images/sliders/'.$data->photo)}})">
									<div class="container">
										<div class="row">
											<div class="col-lg-12">
												<div class="slider-content">
													 layer 1 
													<div class="layer-1">
														<h4 style="font-size: {{$data->subtitle_size}}px; color: {{$data->subtitle_color}}" class="subtitle subtitle{{$data->id}}" data-animation="animated {{$data->subtitle_anime}}">  @if(!$slang)
              @if($lang->id == 2)
             {{$data->subtitle_text_ar}}
              @else 
              {{$data->subtitle_text}}
              @endif 
                @else  
              @if($slang == 2) 
              {{$data->subtitle_text_ar}}
              @else
              {{$data->subtitle_text}}
              @endif
                @endif</h4>
														<h2 style="font-size: {{$data->title_size}}px; color: {{$data->title_color}}" class="title title{{$data->id}}" data-animation="animated {{$data->title_anime}}"> 
			 @if(!$slang)
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
               @endif</h2>
													</div>
													 layer 2 
													<div class="layer-2">
														<p style="font-size: {{$data->details_size}}px; color: {{$data->details_color}}"  class="text text{{$data->id}}" data-animation="animated {{$data->details_anime}}">  @if(!$slang)
                                                          @if($lang->id == 2)
                                                         {{$data->details_text_ar}}
                                                          @else 
                                                          {{$data->details_text}}
                                                          @endif 
                                                           @else  
                                                          @if($slang == 2) 
                                                          {{$data->details_text_ar}}
                                                          @else
                                                          {{$data->details_text}}
                                                          @endif
                                                            @endif</p>
                                            			</div>
													 layer 3 
													<div class="layer-3">
														<a href="{{$data->link}}" target="_blank" class="mybtn1"><span>@if(!$slang)
                                                          @if($lang->id == 2)
                                                        {{$data->btn_text_ar}}
                                                          @else 
                                                          {{$data->btn_text}}
                                                          @endif 
                                                           @else  
                                                          @if($slang == 2) 
                                                          {{$data->btn_text_ar}}
                                                          @else
                                                          {{$data->btn_text}}
                                                          @endif
                                                            @endif <i class="fas fa-chevron-right"></i></span></a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				@endif

			@endif

		</section>
         	@endif
        	@if($ps->featured_category == 1)

	{{-- Slider buttom Category Start --}}
	<section class="slider-buttom-category d-md-block">
		<div class="container-fluid">
			<div class="row">
				@foreach($categories->where('is_featured','=',1) as $cat)
					<div class="col-xl-2 col-lg-3 col-md-4 sc-common-padding">
					    @if(!$slang)
                                  @if($lang->id == 2)
                                <a href="{{ route('front.category',['category' => $cat->slug_ar ,'lang' => $sign]) }}" class="single-category">
                                  @else 
                                <a href="{{ route('front.category',['category' => $cat->slug ,'lang' => $sign]) }}" class="single-category">
                                  @endif 
                                    @else  
                                  @if($slang == 2) 
                            <a href="{{ route('front.category',['category' => $cat->slug_ar ,'lang' => $sign]) }}" class="single-category">
                                  @else
                            <a href="{{ route('front.category',['category' => $cat->slug ,'lang' => $sign]) }}" class="single-category">
                                      @endif
                                      @endif
						
							<div class="left">
								<h5 class="title">	@if(!$slang)
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
                                      @endif
                    									
								</h5>
								<p class="count">
									{{ count($cat->products) }} {{ $langg->lang4 }}
								</p>
							</div>
							<div class="right">
								<img src="{{asset('assets/images/categories/'.$cat->image) }}" alt="">
							</div>
						</a>
					</div>
				@endforeach
			</div>
		</div>
	</section>
	{{-- Slider buttom banner End --}}

	@endif

	@if($ps->featured == 1)
		<!-- Trending Item Area Start -->
		<section  class="trending">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								{{ $langg->lang26 }}
							</h2>
							{{-- <a href="#" class="link">View All</a> --}}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="trending-item-slider">
							@foreach($feature_products as $prod)
								@include('includes.product.slider-product')
							@endforeach
						</div>
					</div>

				</div>
			</div>
		</section>
		<!-- Tranding Item Area End -->
	@endif
	@if($features[5]->status == 1 && $features[5]->active == 1 )
		@foreach(DB::table('offers')->where('content','=',1)->get() as $data)
		<!-- Trending Item Area Start -->
		<section  class="trending">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								@if(!$slang)
              @if($lang->id == 2)
              {{$data->name_ar}}
              @else 
              {{$data->name}}
              @endif 
              @else  
              @if($slang == 2) 
             {{$data->name_ar}}
              @else
              {{$data->name}}
              @endif
               @endif
							</h2>
							{{-- <a href="#" class="link">View All</a> --}}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="trending-item-slider">
						   @php
						   $offers = App\Models\OfferProduct::where('offer_id',$data->id)->get();
						   @endphp
						   @if($offers)
							@foreach($offers as $pro)
							
							@php
						    	$prod= App\Models\Product::find($pro->product_id);
							@endphp
							 @if($prod)       
								@include('includes.product.slider-product')
							@endif	
							@endforeach
						@endif	
						</div>
					</div>

				</div>
			</div>
		</section>
		<!-- Tranding Item Area End -->
		@endforeach
	@endif
	@if($ps->small_banner == 1)
		<!-- Banner Area One Start -->
		<section class="banner-section">
			<div class="container">
				@foreach($top_small_banners->chunk(2) as $chunk)
					<div class="row">
						@foreach($chunk as $img)
							<div class="col-lg-6 remove-padding">
								<div class="left">
									<a class="banner-effect" href="{{ $img->link }}" target="_blank">
										<img src="{{asset('assets/images/banners/'.$img->photo)}}" alt="">
									</a>
								</div>
							</div>
						@endforeach
					</div>
				@endforeach
			</div>
		</section>
	
	@endif


<!--	<section id="extraData">
		<div class="text-center">
			<img src="{{asset('assets/images/'.$gs->loader)}}">
		</div>
	</section>-->
	
	
	<section >
		@if($ps->best == 1)
		<!-- Phone and Accessories Area Start -->
		<section class="phone-and-accessories categori-item">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								{{ $langg->lang27 }}
							</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-9">
						<div class="row">
							@foreach($best_products as $prod)
								@include('includes.product.home-product')
							@endforeach
						</div>
					</div>
					<div class="col-lg-3 remove-padding d-none d-lg-block">
						<div class="aside">
							<a class="banner-effect mb-10" href="{{ $ps->best_seller_banner_link }}">
								<img src="{{asset('assets/images/'.$ps->best_seller_banner)}}" alt="">
							</a>
							<a class="banner-effect" href="{{ $ps->best_seller_banner_link1 }}">
								<img src="{{asset('assets/images/'.$ps->best_seller_banner1)}}" alt="">
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Phone and Accessories Area start-->
	@endif

	@if($ps->flash_deal == 1)
		<!-- Electronics Area Start -->
		<section class="categori-item electronics-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								{{ $langg->lang244 }}
							</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="flash-deals">
							<div class="flas-deal-slider">

								@foreach($discount_products as $prod)
									@include('includes.product.flash-product')
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Electronics Area start-->
	@endif

	@if($ps->large_banner == 1)
		<!-- Banner Area One Start -->
		<section class="banner-section">
			<div class="container">
				@foreach($large_banners->chunk(1) as $chunk)
					<div class="row">
						@foreach($chunk as $img)
							<div class="col-lg-12 remove-padding">
								<div class="img">
									<a class="banner-effect" href="{{ $img->link }}">
										<img src="{{asset('assets/images/banners/'.$img->photo)}}" alt="">
									</a>
								</div>
							</div>
						@endforeach
					</div>
				@endforeach
			</div>
		</section>
		<!-- Banner Area One Start -->
	@endif

	@if($ps->top_rated == 1)
		<!-- Electronics Area Start -->
		<section class="categori-item electronics-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								{{ $langg->lang28 }}
							</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="row">

							@foreach($top_products as $prod)
								@include('includes.product.top-product')
							@endforeach

						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Electronics Area start-->
	@endif

	@if($ps->bottom_small == 1)
		<!-- Banner Area One Start -->
		<section class="banner-section">
			<div class="container">
				@foreach($bottom_small_banners->chunk(3) as $chunk)
					<div class="row">
						@foreach($chunk as $img)
							<div class="col-lg-4 remove-padding">
								<div class="left">
									<a class="banner-effect" href="{{ $img->link }}" target="_blank">
										<img src="{{asset('assets/images/banners/'.$img->photo)}}" alt="" style="width:100%;height:auto;">
									</a>
								</div>
							</div>
						@endforeach
					</div>
				@endforeach
			</div>
		</section>
		<!-- Banner Area One Start -->
	@endif

	@if($ps->big == 1)
		<!-- Clothing and Apparel Area Start -->
		<section class="categori-item clothing-and-Apparel-Area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="section-top">
							<h2 class="section-title">
								{{ $langg->lang29 }}
							</h2>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-9">
						<div class="row">
							@foreach($big_products as $prod)
								@include('includes.product.home-product')
							@endforeach



						</div>
					</div>
					<div class="col-lg-3 remove-padding d-none d-lg-block">
						<div class="aside">
							<a class="banner-effect mb-10" href="{{ $ps->big_save_banner_link }}">
								<img src="{{asset('assets/images/'.$ps->big_save_banner)}}" alt="">
							</a>
							<a class="banner-effect" href="{{ $ps->big_save_banner_link1 }}">
								<img src="{{asset('assets/images/'.$ps->big_save_banner1)}}" alt="">
							</a>
						</div>
					</div>
				</div>
			</div>
			</div>
		</section>
		<!-- Clothing and Apparel Area start-->
	@endif

	@if($ps->hot_sale == 1)
		<!-- hot-and-new-item Area Start -->
		<section class="hot-and-new-item">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="accessories-slider">
							<div class="slide-item">
								<div class="row">
								    
								    @if(count($hot_products) > 3)
									<div class="col-lg-3 col-sm-6">
										<div class="categori">
											<div class="section-top">
												<h2 class="section-title">
													{{ $langg->lang30 }}
												</h2>
											</div>

											<div class="hot-and-new-item-slider">
                                            @if(count($hot_products) > 3)
												@foreach($hot_products->chunk(3) as $chunk)
													<div class="item-slide">
														<ul class="item-list">
															@foreach($chunk as $prod)
																@include('includes.product.list-product')
															@endforeach
														</ul>
													</div>
												@endforeach
                                            @else
                                            	<div class="item-slide">
														<ul class="item-list">
															@foreach($hot_products as $prod)
																@include('includes.product.list-product')
															@endforeach
														</ul>
													</div>
                                            @endif
											</div>
										</div>
									</div>
									@endif
									
									@if(count($latest_products) > 3)
									<div class="col-lg-3 col-sm-6">
										<div class="categori">
											<div class="section-top">
												<h2 class="section-title">
													{{ $langg->lang31 }}
												</h2>
											</div>

											<div class="hot-and-new-item-slider">
											    
											   
                                        @if(count($latest_products) > 3)
												@foreach($latest_products->chunk(3) as $chunk)
													<div class="item-slide">
														<ul class="item-list">
															@foreach($chunk as $prod)
																@include('includes.product.list-product')
															@endforeach
														</ul>
													</div>
												@endforeach
                                         @else
                                            	<div class="item-slide">
														<ul class="item-list">
															@foreach($latest_products as $prod)
																@include('includes.product.list-product')
															@endforeach
														</ul>
													</div>
                                          @endif
											</div>
										</div>
									</div>
									@endif	
									
									 @if(count($sale_products) > 3)
									<div class="col-lg-3 col-sm-6">
										<div class="categori">
											<div class="section-top">
												<h2 class="section-title">
													{{ $langg->lang33 }}
												</h2>
											</div>

											<div class="hot-and-new-item-slider">
                                      @if(count($sale_products) > 3)
												@foreach($sale_products->chunk(3) as $chunk)
													<div class="item-slide">
														<ul class="item-list">
															@foreach($chunk as $prod)
																@include('includes.product.list-product')
															@endforeach
														</ul>
													</div>
												@endforeach
									       @else
                                            	<div class="item-slide">
														<ul class="item-list">
															@foreach($sale_products as $prod)
																@include('includes.product.list-product')
															@endforeach
														</ul>
													</div>
                                          @endif			

											</div>
										</div>
									</div>
									@endif	
									
									@if(count($trending_products) > 3)
									<div class="col-lg-3 col-sm-6">
										<div class="categori">
											<div class="section-top">
												<h2 class="section-title">
													{{ $langg->lang32 }}
												</h2>
											</div>

											<div class="hot-and-new-item-slider">
                                    @if(count($trending_products) > 3)
												@foreach($trending_products->chunk(3) as $chunk)
													<div class="item-slide">
														<ul class="item-list">
															@foreach($chunk as $prod)
																@include('includes.product.list-product')
															@endforeach
														</ul>
													</div>
												@endforeach
                                         @else
                                            	<div class="item-slide">
														<ul class="item-list">
															@foreach($trending_products as $prod)
																@include('includes.product.list-product')
															@endforeach
														</ul>
													</div>
                                    @endif
											</div>
										</div>
									</div>
									@endif
							
					
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Clothing and Apparel Area start-->
	@endif


	@if($ps->review_blog == 1)
		<!-- Blog Area Start -->
		<section class="blog-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="aside">
							<div class="slider-wrapper">
								<div class="aside-review-slider">
									@foreach($reviews as $review)
										<div class="slide-item">
											<div class="top-area">
												<div class="left">
													<img src="{{ $review->photo ? asset('assets/images/reviews/'.$review->photo) : asset('assets/images/noimage.png') }}" alt="" style="    height: 104px;
    width: 104px;">
												</div>
												<div class="right">
													<div class="content">
														<h4 class="name"> @if(!$slang)
              @if($lang->id == 2)
             {{ $review->title_ar }}
              @else 
              {{ $review->title }}
              @endif 
          @else  
              @if($slang == 2) 
              {{ $review->title_ar }}
              @else
              {{ $review->title }}
              @endif
          @endif</h4>
														<p class="dagenation"> @if(!$slang)
              @if($lang->id == 2)
             {{ $review->subtitle_ar }}
              @else 
              {{ $review->subtitle }}
              @endif 
          @else  
              @if($slang == 2) 
              {{ $review->subtitle_ar }}
              @else
              {{ $review->subtitle }}
              @endif
          @endif</p>
													</div>
												</div>
											</div>
											<blockquote class="review-text">
												<p> @if(!$slang)
              @if($lang->id == 2)
             {!! $review->details_ar !!}
              @else 
              {!! $review->details !!}
              @endif 
          @else  
              @if($slang == 2) 
              {!! $review->details_ar !!}
              @else
              {!! $review->details !!}
              @endif
          @endif
													
												</p>
											</blockquote>
										</div>
									@endforeach


								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						@foreach(DB::table('blogs')->orderby('views','desc')->take(2)->get() as $blogg)

							<div class="blog-box">
								<div class="blog-images">
									<div class="img">
										<img src="{{ $blogg->photo ? asset('assets/images/blogs/'.$blogg->photo):asset('assets/images/noimage.png') }}" class="img-fluid" alt="">
										<div class="date d-flex justify-content-center">
											<div class="box align-self-center">
												<p>{{date('d', strtotime($blogg->created_at))}}</p>
												<p>{{date('M', strtotime($blogg->created_at))}}</p>
											</div>
										</div>
									</div>

								</div>
								<div class="details">
									<a href="{{route('front.blogshow',['id' => $blogg->id,'lang'=> $sign])}}">
										<h4 class="blog-title">
										    @if(!$slang)
                                                  @if($lang->id == 2)
                                                 {!!strlen($blogg->title_ar) > 70 ? substr($blogg->title_ar,0,70)."..." : $blogg->title_ar!!}
                                                  @else 
                                                  {{strlen($blogg->title) > 40 ? substr($blogg->title,0,40)."..." : $blogg->title}}
                                                  @endif 
                                              @else  
                                                  @if($slang == 2) 
                                                {!!strlen($blogg->title_ar) > 70 ? substr($blogg->title_ar,0,70)."...":$blogg->title_ar!!}
                                                  @else
                                                  {{strlen($blogg->title) > 40 ? substr($blogg->title,0,40)."..." : $blogg->title}}
                                                  @endif
                                              @endif
											
										</h4>
									</a>
									<p class="blog-text">
									     @if(!$slang)
                                              @if($lang->id == 2)
                                             {!!substr(strip_tags($blogg->details_ar),0,400)!!}
                                              @else 
                                             	{{substr(strip_tags($blogg->details),0,170)}}
                                              @endif 
                                          @else  
                                              @if($slang == 2) 
                                              	{!!substr(strip_tags($blogg->details_ar),0,400)!!}
                                              @else
                                              	{{substr(strip_tags($blogg->details),0,170)}}
                                              @endif
                                          @endif
									
									</p>
									<a class="read-more-btn" href="{{route('front.blogshow',['id' => $blogg->id,'lang'=> $sign])}}">{{ $langg->lang34 }}</a>
								</div>
							</div>

						@endforeach

					</div>
				</div>
			</div>
		</section>
		<!-- Blog Area start-->
	@endif


	@if($ps->partners == 1)
		<!-- Partners Area Start -->
		<section class="partners">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section-top">
							<h2 class="section-title">
								{{ $langg->lang236 }}
							</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="partner-slider">
							@foreach($partners as $data)
								<div class="item-slide">
									<a href="{{ $data->link }}" target="_blank">
										<img src="{{asset('assets/images/partner/'.$data->photo)}}" alt="">
									</a>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Partners Area Start -->
	@endif

	@if($ps->service == 1)

	{{-- Info Area Start --}}
	<section class="info-area">
			<div class="container">

					@foreach($services->chunk(4) as $chunk)
	
						<div class="row">
	
							<div class="col-lg-12 p-0">
								<div class="info-big-box">
									<div class="row">
										@foreach($chunk as $service)
											<div class="col-6 col-xl-3 p-0">
												<div class="info-box">
													<div class="icon">
														<img src="{{ asset('assets/images/services/'.$service->photo) }}">
													</div>
													<div class="info">
														<div class="details">
															<h4 class="title"> @if(!$slang)
              @if($lang->id == 2)
             {{ $service->title_ar }}
              @else 
             	{{ $service->title }}
              @endif 
          @else  
              @if($slang == 2) 
              	{{ $service->title_ar }}
              @else
              	{{ $service->title }}
              @endif
          @endif</h4>
															<p class="text">
															     @if(!$slang)
              @if($lang->id == 2)
            {!! $service->details_ar !!}
              @else 
             	{!! $service->details !!}
              @endif 
          @else  
              @if($slang == 2) 
              	{!! $service->details_ar !!}
              @else
              	{!! $service->details !!}
              @endif
          @endif
																
															</p>
														</div>
													</div>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							</div>
	
						</div>
	
					@endforeach
	
			</div>
		</section>
		{{-- Info Area End  --}}

		@endif	
	
		
	</section>
	@endif

@if($main->templatee_select ==11111) 


@include('front.index_demo11111')

@endif

@if($main->templatee_select ==222) 


@include('front.index_demo222')

@endif


	  @if($main->templatee_select ==3) 
	 
	 
     @include('front.index_demo3')
     
	 @endif
	 

	 @if($main->templatee_select ==4) 
	 
	 
     @include('front.index_dem1')
     
	 @endif
	 
	 
	 
	 
	  @if($main->templatee_select ==29) 
	 
	 
     @include('front.index_dem29')
     
	 @endif
	 
	 
	 
	  @if($main->templatee_select ==66) 
	 
	 
     @include('front.index_demo66')
     
	 @endif
	 
	 
	 
	  @if($main->templatee_select ==30) 
	 
	 
     @include('front.index_demo30')
     
	 @endif
	 
	 
	  @if($main->templatee_select == 31) 
	 
	 
       @include('front.index_demo31')
     
	 
	    @endif
	    	  @if($main->templatee_select == 32) 
	 
	 
       @include('front.index_demo32')
     
	 
	    @endif
	    
        @if($main->templatee_select == 34) 
        
        
        @include('front.index_demo34')
        
        
        @endif


	@if($main->templatee_select ==17) 
	 
	 
     @include('front.index_demo17')
     
	 @endif
	 
	 
	 	 
	@if($main->templatee_select ==19) 
	 
	 
     @include('front.index_demo19')
     
	 @endif
	 
	 
@if($main->templatee_select == 20)

@include('layouts.header_demo20')

@endif
@if($main->templatee_select == 21)

@include('layouts.header_demo21')

@endif


@if($main->templatee_select == 23)

@include('layouts.header_demo23')

@endif

@if($main->templatee_select == 24)

@include('layouts.header_demo24')

@endif

	 
	 
	@if($main->templatee_select ==22) 
	 
	 
     @include('front.index_demo22')
     
	 @endif
	 	  @if($main->templatee_select == 20) 
	 
	 
           @include('front.index_demo20')
     
	 
	    @endif
	 	  @if($main->templatee_select == 21) 
	 
	 
           @include('front.index_demo21')
     
	 
	    @endif
	    
	    	  @if($main->templatee_select == 23) 
	 
	 
           @include('front.index_demo23')
     
	 
	    @endif
	    
	    	  @if($main->templatee_select == 24) 
	 
	 
           @include('front.index_demo24')
     
	 
	    @endif
	 
	 
	 @if($main->templatee_select ==16) 
	 
	 
     @include('front.index_demo16')
     
	 @endif
	 @if($main->templatee_select ==166) 
	 
	 
     @include('front.index_demo166')
     
	 @endif
	 
	  @if($main->templatee_select ==7) 
	 
	 
     @include('front.index_demo7')
     
	 @endif
	 
	 @if($main->templatee_select == 9) 
	 
	 
     @include('front.index_demo9')
     
	 @endif
	 
	 
	 	 @if($main->templatee_select == 1111) 
	 
	 
     @include('front.index_demo111')
     
	 @endif
	 
	  @if($main->templatee_select ==10) 
	 
	 
     @include('front.index_demo10')
     
	 @endif
	 
	 @if($main->templatee_select ==15) 
	 
	 
     @include('front.index_demo15')
     
	 @endif
	 
	 @if($main->templatee_select ==155) 
	 
	 
     @include('front.index_demo155')
     
	 @endif
	 
	  @if($main->templatee_select ==111) 
	 
	 
     @include('front.index_demo11')
     
	 @endif
	 
	  @if($main->templatee_select ==14) 
	 
	 
     @include('front.index_demo14')
     
	 @endif
	 
	 
	  @if($main->templatee_select ==11) 
	 
	 
     @include('front.index_demo1')
     
	 
	 @endif
	 
	 
	  @if($main->templatee_select ==55) 
	 
	 
     @include('front.index_demo5')
     
	 
	 @endif
	 
	 
	  @if($main->templatee_select ==5) 
	 
	 
     @include('front.index_dem5')
     
	 
	 @endif
	 
	 
	 
	  @if($main->templatee_select ==12) 
	 
	 
     @include('front.index_demo12')
     
	 
	 @endif
	 
	 
	 
	  @if($main->templatee_select ==13) 
	 
	 
     @include('front.index_demo13')
     
	 
	 @endif
	 
	 
	 
	 
	  @if($main->templatee_select ==18) 
	 
	 
     @include('front.index_dem18')
     
	 
	 @endif
	 
	 
	 
	 
	  @if($main->templatee_select ==2) 
	 
	 
     @include('front.index_demo2')
     
	 
	 @endif
	 
	 
	 
	 
	  @if($main->templatee_select ==25) 
	 
	 
     @include('front.index_dem25')
     
	 
	 @endif
	 
	 @if($main->templatee_select == 26) 
	 
	 
       @include('front.index_demo26')
 
 
    @endif
	 
	 	  @if($main->templatee_select == 28) 
	 
	 
     @include('front.index_demo28')
     
	 
	 @endif
	 
	 
	 	  @if($main->templatee_select == 27) 
	 
	 
     @include('front.index_demo27')
     
	 
	 @endif
	 
	 
	 
	 	  @if($main->templatee_select ==6) 
	 
	 
           @include('front.index_demo6')
     
	 
	    @endif
	    
	    
	    
	 	  @if($main->templatee_select == 8) 
	 
	 
           @include('front.index_demo8')
     
	 
	    @endif
	 
	 
	 
	 
    
     
   @section('scripts')
	<script>
        $(window).on('load',function() {

            setTimeout(function(){

                $('#extraData').load('{{route('front.extraIndex')}}');

            }, 500);
        });

	</script>
	
@endsection

@if($main->templatee_select == 11111)
@include('layouts.footer_demo11111')
@endif
@if($main->templatee_select == 222)
@include('layouts.footer_demo222')
@endif
@if($main->templatee_select == 3)
@include('layouts.footer_demo3')
@endif

@if($main->templatee_select == 4)
@include('layouts.footer1_demo')
@endif

@if($main->templatee_select == 29)
@include('layouts.footer_demo29')
@endif

@if($main->templatee_select == 11)
@include('layouts.footer_demo1')
@endif



@if($main->templatee_select == 55)
@include('layouts.footer_demo5')
@endif


@if($main->templatee_select == 30)
@include('layouts.footer_demo30')
@endif



@if($main->templatee_select == 31)
@include('layouts.footer_demo31')
@endif

@if($main->templatee_select == 32)
@include('layouts.footer_demo32')
@endif

@if($main->templatee_select == 34)
@include('layouts.footer_demo34')
@endif


@if($main->templatee_select == 5)
@include('layouts.footer5_demo')
@endif




@if($main->templatee_select == 12)
@include('layouts.footer_demo12')
@endif



@if($main->templatee_select == 13)
@include('layouts.footer_demo13')
@endif


@if($main->templatee_select == 18)
@include('layouts.footer_demo18')
@endif



@if($main->templatee_select == 2)
@include('layouts.footer_demo2')
@endif



@if($main->templatee_select == 25)
@include('layouts.footer25_demo')
@endif

@if($main->templatee_select == 26)
@include('layouts.footer_demo26')
@endif



@if($main->templatee_select == 6)
@include('layouts.footer_demo6')
@endif


@if($main->templatee_select == 8)
@include('layouts.footer_demo8')
@endif


@if($main->templatee_select == 17)
@include('layouts.footer_demo17')
@endif

@if($main->templatee_select == 22)
@include('layouts.footer_demo22')
@endif


@if($main->templatee_select == 20)
@include('layouts.footer_demo20')
@endif

@if($main->templatee_select == 21)
@include('layouts.footer_demo21')
@endif

@if($main->templatee_select == 23)
@include('layouts.footer_demo23')
@endif

@if($main->templatee_select == 24)
@include('layouts.footer_demo24')
@endif
@if($main->templatee_select == 10)
@include('layouts.footer_demo10')
@endif

@if($main->templatee_select == 15)
@include('layouts.footer_demo15')
@endif

@if($main->templatee_select == 155)
@include('layouts.footer_demo155')
@endif


@if($main->templatee_select == 16)
@include('layouts.footer_demo16')
@endif

@if($main->templatee_select == 166)
@include('layouts.footer_demo166')
@endif

@if($main->templatee_select == 7)
@include('layouts.footer_demo7')
@endif

@if($main->templatee_select == 9)
@include('layouts.footer_demo9')
@endif


@if($main->templatee_select == 111)
@include('layouts.footer_demo11')
@endif

@if($main->templatee_select == 14)
@include('layouts.footer_demo14')
@endif


@if($main->templatee_select == 66)
@include('layouts.footer_demo66')
@endif

@if($main->templatee_select == 1111)
@include('layouts.footer_demo111')
@endif

@if($main->templatee_select == 28)
@include('layouts.footer_demo28')
@endif

@if($main->templatee_select == 27)
@include('layouts.footer_demo27')
@endif


@if($main->templatee_select == 19)
@include('layouts.footer_demo19')
@endif


@if($main->templatee_select ==1)
@include('layouts.footer')
@endif



