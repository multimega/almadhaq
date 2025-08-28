@extends('layouts.load')

@section('content')

            <div class="content-area">

              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                        @include('includes.admin.form-error')  
                      <form id="geniusformdata" action="{{route('admin-city-zone--store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('country') }} *</h4>
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select name="country">
                                 @include('includes.countries')
                              </select>
                          
                          </div> 
                   
                        </div>   
                        
                    <!--    <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('From') }} *</h4>
                              
                            </div>
                          </div>
                      
                          <div class="col-lg-7">
                              <select name="from">
                                 
                                  
                              </select>
                          
                          </div>
                        </div>-->
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('City') }} *</h4>
                               
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <select name="city_id[]" required="" multiple>
                                 
                                  
                              </select>
                          </div>
                        </div>  
                        
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Shipment Zones') }} *</h4>
                               
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <select name="zone_id" required="">
                                 @foreach($zones as $s)
                                  <option value="{{$s->id}}">{{$s->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                        </div> 
             
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Create') }}</button>
                          </div>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<script>
      
        $(document).ready(function(){
             $("Select[name='country']").change(function(){
        
              var id= $(this).val();
              var url = "{{ url ('/citiess')}}";
              var token = $("input[name='_token']").val();
              $.ajax({
                  url: url,
                  method: 'POST',
                  data: {id:id, _token:token},
                  success: function(data) {
                     
                    
                    $("[name='city_id[]']").html('');
                    $("[name='city_id[]']").html(data.options);
                     
                  }
                });
              });
        
           });
           
           
           
</script>
@endsection