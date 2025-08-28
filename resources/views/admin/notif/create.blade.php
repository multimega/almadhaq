@extends('layouts.load')

@section('content')

            <div class="content-area">

              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                        @include('includes.admin.form-error') 
                      <form id="geniusformdata" action="{{route('admin-notif-store')}}" method="POST" enctype="multipart/form-data">
                          
                          {{csrf_field()}}
                          
                     <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Users') }} *</h4>
                                
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select name="user_id" >
                                   <option value=" ">For All</option>
                                  @foreach($pro as $p)
                                  <option value="{{$p->id}}">{{$p->name}}</option>
                                  @endforeach
                              </select>
                            
                          </div>
                        </div>



                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Text') }} *</h4>
                                <p class="sub-heading">{{ __('(In English)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="text" placeholder="{{ __('text') }}" required="" value="{{ Request::old('text') }}">
                          </div>
                        </div> 
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Text') }} *</h4>
                                <p class="sub-heading">{{ __('(Arabic)') }}</p>
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <input type="text" class="input-field" name="text_ar" placeholder="{{ __('Arabic text') }}" required="" value="{{ Request::old('text_ar') }}">
                          </div>
                        </div> 
                        
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Type') }} *</h4>
                                
                            </div>
                          </div>
                          <div class="col-lg-7">
                              <select name="type">
                                  <option value="link">Link</option>
                                  <option value="text">Text</option>
                              </select>
                       
                          </div>
                        </div>
                       
                          <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading"> Linked To</h4>
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