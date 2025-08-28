@extends('layouts.admin')

@section('styles')

<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">

@endsection


@section('content')
@php 
$sign = App\Models\Currency::where('is_default',1)->first();
@endphp

            <div class="content-area">

            <div class="home-head mb-4 mb-md-5">
                    <h3>{{ __('Physical Product') }} <a class="add-btn" href="{{ route('admin-prod-types') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h3>
                    <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                            <li class="breadcrumb-item"><a href="javascript:;">{{ __('Products') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin-prod-index') }}">{{ __('All Products') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin-prod-types') }}">{{ __('Add Product') }}</a></li>
                            
                            
                            <li class="breadcrumb-item"><a href="{{ route('admin-prod-physical-create') }}">{{ __('Physical Product') }}</a></li>
                        </ol>
                    </nav>
                </div>
              <!--	<div class="mr-breadcrumb">
								<div class="row">
									<div class="col-lg-12">
											<h4 class="heading">{{ __('Physical Product') }} <a class="add-btn" href="{{ route('admin-prod-types') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
											<ul class="links">
												<li>
													<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
												</li>
											<li>
												<a href="javascript:;">{{ __('Products') }} </a>
											</li>
											<li>
												<a href="{{ route('admin-prod-index') }}">{{ __('All Products') }}</a>
											</li>
												<li>
													<a href="{{ route('admin-prod-types') }}">{{ __('Add Product') }}</a>
												</li>
												<li>
													<a href="{{ route('admin-prod-physical-create') }}">{{ __('Physical Product') }}</a>
												</li>
											</ul>
									</div>
								</div>
				</div>-->
              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                        @include('includes.admin.form-error')  
                      <form id="geniusform" action="{{route('admin-store-notify-to-users')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                      
                        
                        
                        
                             <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Products') }} *</h4>
                                <p class="sub-heading">{{ __('(Products Will Appear In The Notification)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select id="pro" name="product_id[]"  multiple>
                               
                                 @foreach($pro as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                               @endforeach
                              </select>
                          </div>
                        </div>
                        
                         <br> <br> <br>
                             <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Cities') }} *</h4>
                                <p class="sub-heading">{{ __('(Cities Will Appear In The Notification)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select id="zone" name="zone_id[]"  multiple>
                               
                                 @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                               @endforeach
                              </select>
                          </div>
                        </div>
                       
                        <br>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Save') }}</button>
                          </div>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

@endsection

@section('scripts')

<script type="text/javascript">

{{-- Coupon Type --}}

    $('#type').on('change', function() {
      var val = $(this).val();
      var selector = $(this).parent().parent().next();
      if(val == "")
      {
        selector.hide();
      }
      else {
        if(val == 0)
        {
          selector.find('.heading').html('{{ __('Percentage') }} *');
          selector.find('input').attr("placeholder", "{{ __('Enter Percentage') }}").next().html('%');
          selector.css('display','flex');
        }
        else if(val == 1){
          selector.find('.heading').html('{{ __('Amount') }} *');
          selector.find('input').attr("placeholder", "{{ __('Enter Amount') }}").next().html('$');
          selector.css('display','flex');
        }
      }
    });
    
      $('#what').on('change', function() {
      var val = $(this).val();
    
      if(val == "cat")
      {
        $('.cat').css('display','block'); 
         $('.subcat').css('display','none');   
          $('.childcat').css('display','none');   
           $('.brand').css('display','none');   
     }if(val == "subcat")
      {
        $('.subcat').css('display','block'); 
         $('.cat').css('display','none');   
          $('.childcat').css('display','none');   
           $('.brand').css('display','none');  
     } 
     if(val == "childcat")
      {
        $('.childcat').css('display','block'); 
         $('.cat').css('display','none');   
          $('.subcat').css('display','none');   
           $('.brand').css('display','none');  
      }if(val == "brand") {
           $('.brand').css('display','block');  
            $('.cat').css('display','none');   
          $('.childcat').css('display','none');   
           $('.subcat').css('display','none');  
      } 
     
    });


{{-- Coupon Qty --}}

  $(document).on("change", "#times" , function(){
    var val = $(this).val();
    var selector = $(this).parent().parent().next();
    if(val == 1){
    selector.css('display','flex');
    }
    else{
    selector.find('input').val("");
    selector.hide();    
    }
});

</script>

<script type="text/javascript">
    var dateToday = new Date();
    var dates =  $( "#from,#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        changeYear: true,
        minDate: dateToday,
        onSelect: function(selectedDate) {
        var option = this.id == "from" ? "minDate" : "maxDate",
          instance = $(this).data("datepicker"),
          date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
          dates.not(this).datepicker("option", option, date);
    }
});
</script>

@endsection

