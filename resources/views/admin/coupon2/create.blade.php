@extends('layouts.load')

@section('styles')

<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">

@endsection


@section('content')
@php 
$sign = App\Models\Currency::where('is_default',1)->first();
@endphp

            <div class="content-area">

              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                        @include('includes.admin.form-error')  
                      <form id="geniusformdata" action="{{route('admin-coupon-create')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Code') }} *</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="code" placeholder="{{ __('Enter Code') }}" required="" value="">
                          </div>
                        </div>
                       <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Users') }} *</h4>
                                <p class="sub-heading">{{ __('(User Can Use This Code)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select id="user" name="user_id" required="">
                                <option  value=" " >{{ __('For All') }}</option>
                                 @foreach($users as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                               @endforeach
                              </select>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Discount For What') }} *</h4>
                                <p class="sub-heading">{{ __('(select category or brand or sub category or child category)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select id="what" name="what">
                                <option  value=" " >{{ __('For What') }}</option>
                                
                                      <option value="cat">Category</option>
                                      <option value="subcat">Sub Category</option>
                                      <option value="childcat">Child Category</option>
                                      <option value="brand">Brand</option>
                             
                              </select>
                          </div>
                        </div>
                        
                        
                       <div class="cat" style="display:none;">
                            <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Categorys') }} *</h4>
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select id="category_id" name="category_id">
                                <option  value=" " >{{ __('Select  Category') }}</option>
                                 @foreach($cats as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                               @endforeach
                              </select>
                          </div>
                        </div>
                        </div>
                        
                        
                          <div class="subcat" style="display:none;">
                            <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Sub Categorys') }} *</h4>
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select id="subcat_id" name="subcat_id" >
                                <option  value=" " >{{ __('Select Sub  Category') }}</option>
                                 @foreach($subcats as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                               @endforeach
                              </select>
                          </div>
                        </div>
                        </div>
                        
                         <div class="childcat" style="display:none;">
                            <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __(' Child Categorys') }} *</h4>
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select id="childcat_id" name="childcat_id">
                                <option  value=" " >{{ __('Select Child Category') }}</option>
                                 @foreach($childcats as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                               @endforeach
                              </select>
                          </div>
                        </div>
                        </div>
                        
                         <div class="brand" style="display:none;">
                            <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Brands') }} *</h4>
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select id="brand_id" name="brand_id">
                                <option  value=" " >{{ __('Select Brands') }}</option>
                                 @foreach($brands as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                               @endforeach
                              </select>
                          </div>
                        </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Type') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select id="type" name="type" required="">
                                <option value="">{{ __('Choose a type') }}</option>
                                <option value="0">{{ __('Discount By Percentage') }}</option>
                                <option value="1">{{ __('Discount By Amount') }}</option>
                              </select>
                          </div>
                        </div>

                        <div class="row hidden">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading"></h4>
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <input type="text" class="input-field less-width" name="price" placeholder="" required="" value=""><span>{{$sign->sign}}</span>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Quantity') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select id="times" required="">
                                <option value="0">{{ __('Unlimited') }}</option>
                                <option value="1">{{ __('Limited') }}</option>
                              </select>
                          </div>
                        </div>

                        <div class="row hidden">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Value') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field less-width" name="times" placeholder="{{ __('Enter Value') }}" value=""><span></span>
                          </div>
                        </div>

                         <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Limited') }} *</h4>
                                <!--<p class="sub-heading">{{ __('(In Any Language)') }}</p>-->
                            </div>
                          </div>
                          <div class="col-lg-6">
                              
                            <input type="text" class="input-field col-lg-5" name="limited" placeholder="{{ __('Enter Limited') }}" required="" value=""><span class="col-lg-1">{{$sign->sign}}</span>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Start Date') }} *</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="start_date" id="from" placeholder="{{ __('Select a date') }}" required="" value="">
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('End Date') }} *</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="end_date" id="to" placeholder="{{ __('Select a date') }}" required="" value="">
                          </div>
                        </div>
                        
                             <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Products') }} *</h4>
                                <p class="sub-heading">{{ __('(Products in This Code dont choose if u need for all)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select id="pro" name="product[]"  multiple>
                               
                                 @foreach($pro as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                               @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="row">
                                      <div class="col-lg-4">
                                        <div class="left-area">
                                            <h4 class="heading"> {{ __('Coupon Image') }} *</h4>
                                            <small>{{ __('(Preferred SIze: 285 X 410 Pixel)') }}</small>
                                        </div>
                                      </div>
                                      <div class="col-lg-7">
                                        <div class="img-upload">
                                            <div id="image-preview" class="img-preview" style="background: url({{ asset('assets/images/noimage.png') }});">
                                                <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                                                <input type="file" name="photo" class="img-upload" id="image-upload">
                                              </div>

                                        </div>
                                      </div>
                                    </div>
                        <br>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Create Coupon') }}</button>
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

