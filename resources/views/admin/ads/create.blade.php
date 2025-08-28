@extends('layouts.admin')

@section('content')

            <div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">add ads <a class="add-btn" href="{{route('admin-ads-index')}}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                      <ul class="links">
                        <li>
                          <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                          <a href="javascript:;">{{ __('Home Page Settings') }}</a>
                        </li>
                        <li>
                          <a href="{{ route('admin-sl-index') }}">Mobile Setting</a>
                        </li>
                        <li>
                          <a href="{{ route('admin-sl-create') }}">add ads</a>
                        </li>
                      </ul>
                  </div>
                </div>
              </div>
              
            <!--  <ul class="nav nav-tabs">-->
            <!--      <li class="active"><a data-toggle="tab" href="#web">web</a></li>-->
            <!--      <li><a data-toggle="tab" href="#mobile">mobile</a></li>-->
            <!--</ul>-->
              
              <div class="add-product-content">
                <div class="row">
                    <div class="tab-content">
                        
                          <!--<div id="web" class="tab-pane fade in active">-->

                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                      <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                      <form id="geniusform" action="{{route('admin-ads-store')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}
                      @include('includes.admin.form-both') 

                                      {{-- Sub Title Section --}}

                                  <div class="panel panel-default slider-panel">
                                                <div class="panel-heading text-center"><h3>{{ __('Sub Title') }}</h3></div>
                                                <div class="panel-body">
                                              <div class="form-group">
                                                  <div class="col-sm-12">
                                                    <label class="control-label" for="subtitle_text">{{ __('Text') }}*</label>

                                                  <textarea class="form-control" name="title" id="subtitle_text" rows="5"  placeholder="{{ __('Enter Title Text') }}"></textarea>
                                                </div>
                                              </div>


                                              <div class="form-group">
                                                  <div class="col-sm-12">
                                                   <div class="row">

                                                
                                                   </div>

                                                </div>
                                              </div>
                                        </div>
                                        </div>



                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Current Featured Image') }} *</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <div class="img-upload full-width-img">
                                <div id="image-preview" class="img-preview" style="background: url({{ asset('assets/admin/images/upload.png') }});">
                                    <label for="image-upload" class="img-label" id="image-label"><i class="icofont-upload-alt"></i>{{ __('Upload Image') }}</label>
                                    <input type="file" name="photo" class="img-upload" id="image-upload">
                                  </div>
                                  <p class="text">{{ __('Prefered Size: (1920x800) or Square Sized Image') }}</p>
                            </div>

                          </div>
                        </div>


                        <!--<div class="row">-->
                        <!--  <div class="col-lg-4">-->
                        <!--    <div class="left-area">-->
                        <!--        <h4 class="heading">{{ __('Link') }} *</h4>-->
                        <!--    </div>-->
                        <!--  </div>-->
                        <!--  <div class="col-lg-7">-->
                        <!--    <input type="text" class="input-field" name="link" placeholder="{{ __('Link') }}" required="" value="">-->
                        <!--  </div>-->
                        <!--</div>-->

                        <!--<div class="row">-->
                        <!--  <div class="col-lg-4">-->
                        <!--    <div class="left-area">-->
                        <!--        <h4 class="heading">{{ __('Text Position') }}*</h4>-->
                        <!--    </div>-->
                        <!--  </div>-->
                        <!--  <div class="col-lg-7">-->
                        <!--      <select  name="position" required="">-->
                        <!--          <option value="">{{ __('Select Position') }}</option>-->
                        <!--          <option value="slide-one">{{ __('Left') }}</option>-->
                        <!--          <option value="slide-two">{{ __('Center') }}</option>-->
                        <!--          <option value="slide-three">{{ __('Right') }}</option>-->
                        <!--        </select>-->
                        <!--  </div>-->
                        <!--</div>-->
      <!--
                          <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">type</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select  name="type" required="">
                                  <option value="">Select</option>
                                  <option value="1">ads</option>
                                  <option value="2">block</option>
                                </select>
                          </div>
                        </div>
                        -->
                    <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">Slider Linked To</h4>
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select  name="linked" required="">
                                  <option value="">Select</option>
                                  <option value="1">Product</option>
                                  <option value="2">Category</option>
                                  <option value="3">Brand</option>
                                 <option value="4">Sub Category</option>
                                  <option value="5">Offer page</option>
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
                          <select  name="linked_id" required="">
                               
                              </select>
                            
                          </div>
                        </div>
                        <!--<input  type="hidden" name="mobile_setting" value="1">-->
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                              
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <button class="addProductSubmit-btn" type="submit">create ads</button>
                          </div>
                        </div>

                    </form>
                  </div>
                </div>
              <!--</div>-->


                          </div>
                          <!--<div id="mobile" class="tab-pane fade">-->

                 

                          </div>
                        </div>

            </div>
          </div>
        <!--</div>-->

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
                      $("[name='linked_id']").html('');
                    $("[name='linked_id']").html(data.options);
                     
                  }
                });
              });
        
           });
           
           
           
</script>
@endsection
