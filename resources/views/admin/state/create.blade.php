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
                      <form id="geniusformdata" action="{{route('admin-state-create')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                     <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('country') }} *</h4>
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                               <select name="count">
                                   <option value="" >Select Country</option>
                               @foreach (DB::table('countries')->where('status',1)->get() as $dat)
                            	<option value="{{ $dat->id}}" >{{ $dat->country_name }}</option>
                            	
                            	@endforeach
                              </select>
                          
                          </div> 
                   
                        </div>  
                           <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('City ') }} *</h4>
                              
                            </div>
                          </div>
                      
                          <div class="col-lg-7">
                              <select name="state_id">
                                 
                                  
                              </select>
                          
                          </div>
                        </div>
                            <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('State Name') }} *</h4>
                                <p class="sub-heading">{{ __('(In Any Language)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="name" placeholder="{{ __('Enter name') }}" required="" value="">
                          </div>
                        </div> 
                      <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('State Arabic Name') }} *</h4>
                                <p class="sub-heading">{{ __('(بالعربى)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="name_ar" placeholder="{{ __('Enter ِArabic name') }}"  value="">
                          </div>
                        </div>
                      
           
                       <!-- <div class="row">
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
                                    </div>-->
                        <br>
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">{{ __('Create State') }}</button>
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


  $(document).ready(function(){
             $("Select[name='count']").change(function(){
        
              var id= $(this).val();
              var url = "{{ url ('/citiess')}}";
              var token = $("input[name='_token']").val();
              $.ajax({
                  url: url,
                  method: 'POST',
                  data: {id:id, _token:token},
                  success: function(data) {
                      $("[name='state_id']").html('');
                    $("[name='state_id']").html(data.options);    
                    
           
                     
                  }
                });
              });
        
           });
           



</script>

@endsection

