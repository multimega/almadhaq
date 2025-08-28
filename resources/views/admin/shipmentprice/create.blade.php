@extends('layouts.load')

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
                      <form id="geniusformdata" action="{{route('admin-shipment-price-create')}}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                      
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('To Zone') }} *</h4>
                               
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <select name="to">
                                 @foreach($zones as $z)
                                 <option value="{{$z->id}}"> {{$z->name}}</option>
                                 @endforeach
                                  
                              </select>
                          </div>
                        </div>  
                        
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Shipment Method') }} *</h4>
                               
                            </div>
                          </div>
                          <div class="col-lg-7">
                            <select name="shipment_id">
                                 @foreach($shipments as $s)
                                  <option value="{{$s->id}}">{{$s->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                        </div> 
                        
                       


                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Price') }} *</h4>
                                
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <input type="number" class="input-field less-width" name="value" placeholder="{{ __('Price') }}" required="" value="" min="0" step="1"><span>{{$sign->sign}}</span>
                          </div>
                        </div>  
                        <div class="row">
                          <div class="col-lg-4">
                            <div class="left-area">
                                <h4 class="heading">{{ __('Extra Price') }} *</h4>
                                
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <input type="number" class="input-field less-width" name="extra" placeholder="{{ __('Extra Value') }}" required="" value="" min="0" step="1"><span>{{$sign->sign}}</span>
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