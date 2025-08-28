	
@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();


@endphp	
	@forelse($shipments as $s)
							                    	<div class="radio-design">
										<input type="radio" class="shipment_id" id="free-package{{$s->id}}" name="shipment" value="{{$s->id}}" {{ ($loop->first) ? 'checked' : '' }}  required> 
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
								
							<label > 
		                    		No Delivery in This City
				</label>
						                    	@endforelse
						                    	
						                    	
<script>
      
        $(document).ready(function(){
            if($("input[name='shipment']:checked").val()){
                 $("#final-btn").removeAttr("disabled");
            }else{
                
                if($('#shipop').val() == "shipto"){
                 $("#final-btn").prop("disabled",true);
                 alert('No Delivery in This City');
                }
            }
        
       
              });
        
           
           
           
           
</script>