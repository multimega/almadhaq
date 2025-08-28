
<?php

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();

 $gs = App\Models\Generalsetting::findOrFail(1);
 

 
 ?>
 
 <?php
    if(!empty($shipment)){
  $shipp = App\Models\Shipment::find($shipment->shipment_id);
    }
  $shipping_price = 0;
  $shipping_tax = 0;
  
   if (Session::has('currency')) 
            {
              $curr = App\Models\Currency::find(Session::get('currency'));
            }
            else
            {
                $curr = App\Models\Currency::where('is_default','=',1)->first();
            }
 
 

        $oldCart = Session::get('cart');
        $cart = new App\Models\Cart($oldCart);
        $weights= 0;
	                      foreach($cart->items as $key => $prod){
						     $pro = App\Models\Product::findOrFail($prod['item']['id']);
                                if($prod['item']['free_ship'] != 1){    
						    if($pro['measure'] == "Gram"){
             $weights += ($pro['scale']/ 1000 ) * $prod['qty'];
                }else{
                    
                $weights += $pro['scale'] * $prod['qty'];
                }
                                }
							 
							  
							  
							  
						
	                      
						    
	                       
	                         }
	                  if(!empty($shipment) ){
						  
                               if($weights > 0){
                              $shippingvalue = round(($weights - 1)) * ($shipment->extra * $curr->value );
                              $t = $shippingvalue + (1 * ($shipment->value * $curr->value ));
                              $shipping_price += $t;
                              
                              $shipping_price += ($shipp->shipping_tax /100 * $shipping_price ) ;
                               if(($cart->totalPrice * $curr->value ) >= ($gs->free_shipping * $curr->value ) ){
                                     $shipping_price = 0 ;
                                  
                                }
                                }
                              
                               	
                             
                            
						          
						          
						      }
	                         
	                         
						      if(!empty($shipment) ){ 
						          
						          if($gs->currency_format == 0){
								 echo '<input type="hidden" value="'.round($shipping_price,2 )  .'" class="shipping_price" >'.$curr->sign  .' '. round($shipping_price,2 );
							}else {
							 echo '<input type="hidden" value="'.round($shipping_price,2 )  .'" class="shipping_price" >'.round($shipping_price,2 )  .' '. $curr->sign;
							}
						      }else{
						           echo '<input type="hidden" value="0" class="shipping_price" >'.'0';
						      }
						    
						    
	                       ?>
	                       

			