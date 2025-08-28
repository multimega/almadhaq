@extends('layouts.admin')

@section('content')

            <div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Edit Slider') }} <a class="add-btn" href="{{route('admin-mobilesetting-index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                      <ul class="links">
                        <li>
                          <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                          <a href="javascript:;">{{ __('Home Page Settings') }}</a>
                        </li>
                        <li>
                          <a href="{{ route('admin-sl-index') }}">{{ __('Sliders') }}</a>
                        </li>
                        <li>
                          <a href="{{route('admin-sl-edit',$data->id)}}">{{ __('Edit') }}</a>
                        </li>
                      </ul>
                  </div>
                </div>
              </div>
              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                      <form id="geniusform" action="{{route('admin-sl-update',$data->id)}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                      @include('includes.admin.form-both') 

                                    
                                    

                                    <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Current Featured Image') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <div class="img-upload full-width-img">
                                <div id="image-preview" class="img-preview" style="background: url({{ $data->photo ? asset('assets/images/sliders/'.$data->photo):asset('assets/images/noimage.png') }});">
                                    <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                                    <input type="file" name="photo" class="img-upload" id="image-upload">
                                  </div>
                                  <p class="text">{{ __('Prefered Size: (1920x800) or Square Sized Image') }}</p>
                            </div>

                          </div>
                        </div>


                   
                        
                             <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">Slider Linked To</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select  name="linked" required="">
                                  <option  value="">Select</option>
                                  <option {{ $data->linked == 1 ? "selected" : "" }} value="1">Product</option>
                                  <option {{ $data->linked == 2 ? "selected" : "" }} value="2">Category</option>
                                  <option {{ $data->linked == 3 ? "selected" : "" }} value="3">Brand</option>
                                  <option {{ $data->linked == 4 ? "selected" : "" }} value="4">Sub Category</option>
                                 
                                  <option {{ $data->linked == 5 ? "selected" : "" }} value="5">Offer page</option>
                                </select>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">Link Id</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                          <select  name="link_id" required="">
                                <option value="{{ $data->link_id }}">{{ $data->link_id }}</option>
                              </select>
                            
                          </div>
                        </div>
                        <input  type="hidden" name="mobile_setting" value="1">



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
<script>
      
        $(document).ready(function(){
             $("Select[name='linked']").change(function(){
        
              var id= $(this).val();
              var url = "{{ url ('/mobilesetting/slide')}}";
              var token = $("input[name='_token']").val();
              $.ajax({
                  url: url,
                  method: 'POST',
                  data: {id:id, _token:token},
                  success: function(data) {
                      $("[name='link_id']").html('');
                    $("[name='link_id']").html(data.options);
                     
                  }
                });
              });
        
           });
           
           
           
</script>
@endsection
