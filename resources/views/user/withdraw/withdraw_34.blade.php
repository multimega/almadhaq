@extends('layouts.front_34')

@section('content')

<div class="acc-settings">
    <div class="row m-0">
        @include('includes.user-dashboard-34-sidebar')
        <div class="col-lg-10 col-md-9 hidden-classes mb-3">
            <div>
                <div class="settings-container">
                    <div class="settings-header d-flex justify-content-between align-items-center">
                        <h3>{{ $langg->lang336 }}</h3>
    					<a class="btn btn-success" href="{{route('user-wwt-index-34')}}"> <i class="fas fa-arrow-left"></i> {{ $langg->lang337 }}</a>
					</div>
                    <div class="no-orders text-center">
                         <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                            <form id="userform" class="form-horizontal text-left" action="{{route('user-wwt-store')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @include('includes.admin.form-both') 
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="name">{{ $langg->lang355 }} {{ App\Models\Product::vendorConvertPrice(Auth::user()->affilate_income) }}</label>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="name">{{ $langg->lang338 }} *</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="methods" id="withmethod" required>
                                            <option value="">{{ $langg->lang339 }}</option>
                                            <option value="Paypal">{{ $langg->lang340 }}</option>
                                            <option value="Skrill">{{ $langg->lang341 }}</option>
                                            <option value="Payoneer">{{ $langg->lang342 }}</option>
                                            <option value="Bank">{{ $langg->lang343 }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="name">{{ $langg->lang344 }} *</label>
                                    <div class="col-sm-12">
                                        <input name="amount" placeholder="{{ $langg->lang344 }}" class="form-control"  type="text" value="{{ old('amount') }}" required>
                                    </div>
                                </div>
                                <div id="paypal" style="display: none;">
                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="name">{{ $langg->lang345 }} *</label>
                                        <div class="col-sm-12">
                                            <input name="acc_email" placeholder="{{ $langg->lang345 }}" class="form-control" value="{{ old('email') }}" type="email">
                                        </div>
                                    </div>
                                </div>
                                <div id="bank" style="display: none;">
                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="name">{{ $langg->lang346 }} *</label>
                                        <div class="col-sm-12">
                                            <input name="iban" value="{{ old('iban') }}" placeholder="{{ $langg->lang346 }}" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="name">{{ $langg->lang347 }} </label>
                                        <div class="col-sm-12">
                                            <input name="acc_name" value="{{ old('accname') }}" placeholder="{{ $langg->lang347 }}" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="name">{{ $langg->lang348 }} *</label>
                                        <div class="col-sm-12">
                                            <input name="address" value="{{ old('address') }}" placeholder="{{ $langg->lang348 }}" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-12" for="name">{{ $langg->lang349 }} *</label>
                                        <div class="col-sm-12">
                                            <input name="swift" value="{{ old('swift') }}" placeholder="{{ $langg->lang349 }}" class="form-control" type="text">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="name">{{ $langg->lang350 }} *</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="reference" rows="6" placeholder="{{ $langg->lang350 }}">{{ old('reference') }}</textarea>
                                    </div>
                                </div>
                                <div id="resp" class="col-md-12">
                                    <span class="help-block">
                                        <strong>{{ $langg->lang351 }} ${{ $gs->withdraw_fee }} {{ $langg->lang352 }} {{ $gs->withdraw_charge }}% {{ $langg->lang353 }}</strong>
                                    </span>
                                </div>
                                <hr>
                                <div class="add-product-footer">
                                    <button name="addProduct_btn" type="submit" class="btn btn-success">{{ $langg->lang354 }}</button>
                                </div>
                            </form>
						</div>
                   </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection


@section('scripts')


<script type="text/javascript">
  

    $("#withmethod").change(function(){
        var method = $(this).val();
        if(method == "Bank"){

            $("#bank").show();
            $("#bank").find('input, select').attr('required',true);

            $("#paypal").hide();
            $("#paypal").find('input').attr('required',false);

        }
        if(method != "Bank"){
            $("#bank").hide();
            $("#bank").find('input, select').attr('required',false);

            $("#paypal").show();
            $("#paypal").find('input').attr('required',true);
        }
        if(method == ""){
            $("#bank").hide();
            $("#paypal").hide();
        }

    })

</script>

@endsection