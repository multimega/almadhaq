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
                      <form id="geniusformdatas" action="{{route('admin-country-price-updates',$data->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Country') }} *</h4>
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            		 <select name="country" class="input-field" >
																			     <option {{$data->country == 'Egypt' ? 'selected' : ''}} value="Egypt">Egypt</option>
																			     <option {{$data->country == 'United States' ? 'selected' : ''}} value="United States">United States</option>
																			     <option {{$data->country == 'United Kingdom' ? 'selected' : ''}} value="United Kingdom">United Kingdom</option>
																			     <option {{$data->country == 'Germany' ? 'selected' : ''}} value="Germany">Germany</option>
																			     <option {{$data->country == 'Ireland' ? 'selected' : ''}} value="Ireland">Ireland</option>
																			     <option {{$data->country == 'Hong Kong' ? 'selected' : ''}} value="Hong Kong">Hong Kong</option>
																			     <option {{$data->country == 'Russia' ? 'selected' : ''}} value="Russia">Russia</option>
																			     <option {{$data->country == 'Canada' ? 'selected' : ''}} value="Canada">Canada</option>
																			     <option {{$data->country == 'South Korea' ? 'selected' : ''}} value="South Korea">South Korea</option>
																			     <option {{$data->country == 'Singapore' ? 'selected' : ''}} value="Singapore">Singapore</option>
																			     <option {{$data->country == 'Ukraine' ? 'selected' : ''}} value="Ukraine">Ukraine</option>
																			     <option {{$data->country == 'China' ? 'selected' : ''}} value="China">China</option>
																			     <option {{$data->country == 'Japan' ? 'selected' : ''}} value="Japan">Japan</option>
																			     <option {{$data->country == 'Netherlands' ? 'selected' : ''}} value="Netherlands">Netherlands</option>
																			     <option {{$data->country == 'Greenland' ? 'selected' : ''}} value="Greenland">Greenland</option>
																			     <option {{$data->country == 'Turkey' ? 'selected' : ''}} value="Turkey">Turkey</option>
																			     
																			 </select>
                          </div>
                        </div> 
               
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('price') }} *</h4>
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="number" class="input-field" name="price" placeholder="{{ __('Enter price') }}" required="" value="{{$data->price}}">
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

