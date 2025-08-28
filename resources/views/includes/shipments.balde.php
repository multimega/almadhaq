	@forelse($shipments as $s)
							       	<div class="radio-design">
										<input type="radio" class="shipment_id" id="free-package{{$s->id}}" name="shipment" value="{{$s->id}}" > 
										<span class="checkmark"></span>
										<label for="free-package{{$s->id}}"> 
									 @if(!$slang)
              @if($lang->id == 2)
              {{$s->name_ar}}
              @else 
              {{$s->name}}
              @endif 
          @else  
              @if($slang == 2) 
             {{$s->name_ar}}
              @else
              {{$s->name}}
              @endif
          @endif	
												<small> @if(!$slang)
              @if($lang->id == 2)
              {{$s->desc_ar}}
              @else 
             {{$s->desc}}
              @endif 
          @else  
              @if($slang == 2) 
              {{$s->desc_ar}}
              @else
             {{$s->desc}}
              @endif
          @endif </small>
										</label>
								</div>	
								
								@empty
								
								<p>No SHipment For This City</p>
						                    	@endforelse