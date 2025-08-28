                     @php
                      $is_first = true;
                      
                        $cur = \Session::get('currency');
                      if( $cur){
                          $currency = \App\Models\Currency::find($cur);
                      }else{
                          $currency = \App\Models\Currency::where('is_default',1)->first();
                      }
      
                      @endphp
                    
                      @foreach($colorss as $key => $data1)
                      @if($data1->size_qty > 0)
                      <li class=" click {{ $is_first ? 'active' : '' }}">
                        <span class="box dco boxz" data-color="{{ $data1->colors }}" style="background-color: {{ $data1->colors }}">
                                 <input type="hidden" class="color_sku" value="{{$data1->color_sku}}">
                         <input type="hidden" class="color_qty" value="{{ $data1->size_qty }}">   
                         <input type="hidden" class="color_price"  value="{{ $data1->size_price * $currency->value}}"> 
                        </span>
                        
                      </li>
                      @endif
                      @php
                      $is_first = false;
                      @endphp
                      
                      @endforeach
   
 <script>  
                      <script>
      
     
              $("li.click").click(function(){

              $("li.hide").show();
                

            
                
              
        
           
           
      // Product Details Product Color Active Js Code
$('.dco').on('click', function () {
    $('.qttotal').html('1');
colors = $(this).data('color');
size_qty = $(this).find('.color_qty').val();
size_price = $(this).find('.color_price').val();
var parent = $(this).parent();
$('.dco').removeClass('active');
parent.addClass('active');
stock = size_qty;
  total = getAmount()+parseFloat(size_price);
         total = total.toFixed(2);
        

         var pos = $('#curr_pos').val();
         var sign = $('#curr_sign').val();
         if(pos == '0')
         {
         $('#sizeprice').html(sign+total);
         }
         else {
         $('#sizeprice').html(total+sign);
         }   
});     
           
</script>

