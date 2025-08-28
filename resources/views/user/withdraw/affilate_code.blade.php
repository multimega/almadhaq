@extends('layouts.front')
@section('content')      

@php 




      
          $slang = Session::get('language');
         $lang  = DB::table('languages')->where('is_default','=',1)->first();
   


     $cur = Session::get('currency');
      if( $cur){
          $currency = App\Models\Currency::find($cur);
      }else{
          $currency = App\Models\Currency::where('is_default',1)->first();
      }
  
   $data = App\Models\Generalsetting::find(1); 

@endphp


<section class="user-dashbord">
    <div class="container">
      <div class="row">
        @include('includes.user-dashboard-sidebar')
<div class="col-lg-8">
                    <div class="user-profile-details">
                        <div class="account-info">
                            <div class="header-area">
                                <h4 class="title">
                                    {{ $langg->lang322 }}
                                </h4>
                            </div>
                            <div class="edit-info-area">
                                
                                <div class="body">
                                        <div class="edit-info-area-form">
                                                <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                                                <form>
                                                    @include('includes.admin.form-both') 

                                                 

                                      
                            
                            
                              @php
               
                  $usrid = Auth::guard('web')->user()->id;
                  
                  $prodids = \App\Models\AffilateUsers::where('user_id',$usrid)->pluck('product_id');
                  
                  
                   $prods = \App\Models\Product::whereIn('id',$prodids)->get();
              
              
                  
              @endphp
                            
                            
                            	 @foreach($prods as $key=>$prod)
                               <div class="row">
                                                        <div class="col-lg-4 text-right pt-2 f-14">
                                                            <label>{{ $langg->lang323 }} <a id="affilate_click" data-toggle="tooltip" data-key="{{$key}}" data-placement="top" title="Copy"  href="javascript:;" class="mybtn1 copy"><i class="fas fa-copy"></i></a></label>
                                                            <br>
                                                            <small>{{ $langg->lang324 }}</small>
                                                        </div>
                                                        <div class="col-lg-8 pt-2">
                                                             <textarea id="affilate_address{{$key}}" class="input-field affilate" name="address" readonly="" row="5">{{ url('/'.$sign.'/'.'item/'.$prod->slug).'/?affid='.$prod->affiliate_setting_id.'&usrid='.$usrid}}</textarea>
                                                        </div>
                                                    </div>
                                                    
                                    @endforeach                
                                                    
                                                    
                            
                             
                                   
                                   
                                
                            
                        </div>
                    </div>
                </div>
      </div>
    </div>
  </section>

@endsection

@section('scripts')

<script type="text/javascript">
    $('#affilate_click').on('click',function(){
        
      var id =$(this).data('key');
       var copyText =  document.getElementById("affilate_address"+id);

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

    });

    $('#affilate_html_click').on('click',function(){
       var copyText =  document.getElementById("affilate_html");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

    });

</script>


@endsection