@php
$notifications = App\Models\Notifications::where('user_id', Auth::guard('web')->user()->id)->orderby('id','desc')->take(10)->get();
$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();
@endphp



<div class="dropdownmenu-wrapper" style="padding:0px">
												<!-- End .dropdown-cart-header -->
												<ul class="dropdown-cart-products">
												    
												    @foreach($notifications as $n)
													<li class="product " @if($n->read_at != null) style="background: #e6e5e5;"  @endif >
															<div class="product-details">
																<div class="content">
																	<a href="{{route('readnotif',['id' => $n->id , 'lang' => $sign])}}" style="
    margin: 10px;
"><h4 class="product-title">@if(!$slang)
                                                                                          @if($lang->id == 2)
                                                                 {{$n->text_ar}}
                                                                  @else 
                                                                  {{$n->text}}
                                                                  @endif 
                                                              @else  
                                                                  @if($slang == 2) 
                                                                  {{$n->text_ar}}
                                                                  @else
                                                                  {{$n->text}}
                                                                  @endif
                                                              @endif </h4>
                                                                      
                                                                     </a>

																	
																</div>
															</div><!-- End .product-details -->

															
														</li><!-- End .product -->
														
														@endforeach
												</ul><!-- End .cart-product -->
                                            <div>
                                               <a href="{{route('user-notifications')}}">{{ $langg->lang807 }}</a>
                                            </div>
												<!-- End .dropdown-cart-total -->

												<!-- End .dropdown-cart-total -->
										</div>
										