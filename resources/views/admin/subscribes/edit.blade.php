@extends('layouts.load')

@section('styles')

<link href="{{asset('assets/admin/css/jquery-ui.css')}}" rel="stylesheet" type="text/css">

@endsection


@section('content')

            <div class="content-area">

              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                        @include('includes.admin.form-error')  
                      <form id="geniusformdata" action="{{route('admin-subscribes-update',$data->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                
                       <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Users') }} *</h4>
                                
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select id="user" name="user_id" required="">
                                 @foreach($users as $item)
                                <option value="{{$item->id}}" {{$item->id == $data->user_id ? "selected" : "" }}>{{$item->name}}</option>
                               @endforeach
                              </select>
                          </div>
                        </div>   
                        
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Products') }} *</h4>
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select id="user" name="product_id" required="">
                                 @foreach($pro as $item)
                                <option value="{{$item->id}}" {{$item->id == $data->product_id ? "selected" : "" }}>{{$item->name}}</option>
                               @endforeach
                              </select>
                          </div>
                        </div>
              

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading"> {{ __('price') }}</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field less-width" name="package_price" placeholder="" required="" value="{{$data->package_price }}">
                          </div>
                        </div>

                  

                        <div class="row ">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('paid via') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field less-width" name="paid_via" placeholder="{{ __('Enter paid via') }}" value="{{$data->paid_via }}"><span></span>
                          </div>
                        </div>
                        
                        <div class="row ">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('package details') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <div class="text-editor">
                            <textarea type="text" class="nic-edit-p" name="package_details" placeholder="{{ __('Enter package details') }}" value="">{{$data->package_details }}</textarea>
                             </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Status') }} *</h4>
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select id="user" name="status" required="">
                                
                                <option value="approved" {{$data->status == "approved" ? "selected" : "" }}>approved</option>
                                <option value="waiting" {{$data->status == "waiting" ? "selected" : "" }}>waiting</option>
                                <option value="declined" {{$data->status == "declined" ? "selected" : "" }}>declined</option>
                               
                              </select>
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
                            <input type="text" class="input-field" name="start_date" id="from" placeholder="{{ __('Select a date') }}" required="" value="{{$data->start_date }}">
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
                            <input type="text" class="input-field" name="end_date" id="to" placeholder="{{ __('Select a date') }}" required="" value="{{$data->end_date }}">
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

{{-- Coupon Function --}}

(function () {

      var val = $('#type').val();
      var selector = $('#type').parent().parent().next();
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
})();

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


{{-- Coupon Qty --}}



(function () {

    var val = $("#times").val();
    var selector = $("#times").parent().parent().next();
    if(val == 1){
    selector.css('display','flex');
    }
    else{
    selector.find('input').val("");
    selector.hide();    
    }

})();


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

