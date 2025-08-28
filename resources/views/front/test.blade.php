<select class="form-control" id="city" name="city" required="">
												        @php
												        $country =  DB::table('countries')->where('is_default', 1)->first();
												        
												        @endphp
												        @if($country)
												        @php
												        
												          $cities = App\Models\Zone::where('country_id',$country->id)->get()
												        @endphp
												           <option value="">Select City</option>
												       	@foreach($cities as $data)
												       	
												       	 @if($data->status == 1)
                                                     <option value="{{$data->name }}"> {{ $data->name }} </option>
                                                       @endif
                                                  
                                                     @endforeach
                                                         </select>
                                                         
                                                         
                                                         
                                                         
                                    
                                    
                                    
                                    
                                    
                                                         @if(Auth::check())
												        @php
												            $addresss = App\Models\Address::where('user_id',Auth::guard('web')->user()->id )->get()
												        @endphp
												       
												        <select class="form-control" id="city" name="city" required="">
												        @php
												        
												            $country =  DB::table('countries')->where('is_default', 1)->first();
												        
												        @endphp
												        
												        @if($country)
												            @php
												        
												                $cities = App\Models\Zone::where('country_id',$country->id)->get()
												                
												            @endphp
												            
												            <option value="">Select City</option>
												           
												       	        @foreach($cities as $data)
												       	
												       	            @if($data->status == 1)
                                                                        <option value="{{$data->name }}"> {{ $data->name }} </option>
                                                                    @endif
                                                  
                                                                @endforeach
                                                         </select>
                                                         
                                                     
												      <!-- <input class="form-control" type="text" name="city"
														placeholder="{{ $langg->lang158 }}" required=""
														value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->city : '' }}">-->
													    @else
														
														    <select class="form-control"  name="city" required="">
                                                              <option value="">Select City</option>
                                                            </select> 
                                                          
                                                          
                                                        @endif
                                                
                                                    <!--لو هو مش مسجل دخول -->
                                                
                                                
                                                    @else
                                                      
                                                        <select class="form-control" id="city" name="city" required="">
                                                        @php
                                                        
												            $country =  DB::table('countries')->where('is_default',1)->first();
												        
												        @endphp
												       
												        @if($country)
												        @php
												        
												          $cities = App\Models\Zone::where('country_id',$country->id)->get()
												        @endphp
												             <option value="">Select City</option>
												       	        @foreach($cities as $data)
												       	
												       	            @if($data->status == 1)
                                                                        <option value="{{$data->name }}" > {{ $data->name }} </option>
                                                                    @endif
                                                      
                                                                @endforeach
                                                        </select>
                                                         
                                                     
												      <!-- <input class="form-control" type="text" name="city"
														placeholder="{{ $langg->lang158 }}" required=""
														value="{{ Auth::guard('web')->check() ? Auth::guard('web')->user()->city : '' }}">-->
														@else
														
														    <select class="form-control"  name="city" required="">
                                                              <option value="">Select City</option>
                                                          </select> 
                                                          
                                                          
                                                        @endif
                                                      
                                                    @endif
                                                         