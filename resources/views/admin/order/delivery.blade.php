@extends('layouts.load')
@section('content')

<div class="content-area p-0">
    <div class="add-product-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="product-description">
                    <div class="body-area p-0">
                        @include('includes.admin.form-error')  
                        <form  action="{{route('admin-order-update',$data->id)}}" class="exp-form" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
        								<label>{{ __('Payment Status') }}*</label>
        								<select name="payment_status" class="form-control" required="">
                                            <option value="Pending" {{$data->payment_status == 'Pending' ? "selected":""}}>{{ __('Unpaid') }}</option>
                                            <option value="Completed" {{$data->payment_status == 'Completed' ? "selected":""}}>{{ __('Paid') }}</option>
                                        </select>
        							</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
        								<label>{{ __('Delivery Status') }}*</label>
        								<select name="status" class="form-control" required="">
                                            <option value="pending" {{ $data->status == "pending" ? "selected":"" }}>{{ __('Pending') }}</option>
                                            <option value="processing" {{ $data->status == "processing" ? "selected":"" }}>{{ __('Processing') }}</option>
                                            <option value="on delivery" {{ $data->status == "on delivery" ? "selected":"" }}>{{ __('On Delivery') }}</option>
                                            <option value="completed" {{ $data->status == "completed" ? "selected":"" }}>{{ __('Completed') }}</option>
                                            <option value="declined" {{ $data->status == "declined" ? "selected":"" }}>{{ __('Declined') }}</option>
                                      </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
        								<label>{{ __('Track Note') }}* <small>{{ __('(In Any Language)') }}</small></label>
        								<textarea class="form-control" name="track_text" placeholder="{{ __('Enter Track Note Here') }}"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
    							<div class="col-lg-12 text-center">
    								<button class="main-light-btn py-3" type="submit">{{ __('Save') }} <i class="fas fa-check ms-3"></i></button>
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

@endsection

