@extends('layouts.load')
@section('content')


{{-- ADD ORDER TRACKING --}}

<div class="add-product-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="product-description">
                <div class="body-area p-0">
                    <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                <input type="hidden" id="track-store" value="{{route('admin-order-track-store')}}">
                <form id="trackform" action="{{route('admin-order-track-store')}}" class="exp-form" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @include('includes.admin.form-both')  

                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
								<label>{{ __('Title') }}* <small>{{ __('(In Any Language)') }}</small></label>
                                <textarea class="form-control" id="track-title" name="title" placeholder="{{ __('Title') }}" required=""></textarea>
							</div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>{{ __('Details') }} * <small>{{ __('(In Any Language)') }}</small></label>
                                <textarea class="form-control" id="track-details" name="text" placeholder="{{ __('Details') }}" required=""></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <button class="main-light-btn py-3" id="track-btn" type="submit">{{ __('ADD') }} <i class="fas fa-check ms-3"></i></button>
                            <button class="main-light-btn py-3 bg-danger ml=3 d-none" id="cancel-btn" type="button">{{ __('Cancel') }}</button>
                            <input type="hidden" id="add-text" class="main-light-btn py-3 bg-success" value="{{ __('ADD') }}">
                            <input type="hidden" id="edit-text" class="main-light-btn py-3 bg-primary" value="{{ __('UPDATE') }}">
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>

<h5 class="text-center">TRACKING DETAILS</h5>

<hr>

{{-- ORDER TRACKING DETAILS --}}

<div class="content-area no-padding">
	<div class="add-product-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="product-description">
					<div class="body-area">
                        <div class="table-responsive show-table ml-3 mr-3">
                            <table class="table" id="track-load" data-href={{ route('admin-order-track-load',$order->id) }}>
                                <tr>
                                    <th>{{ __("Title") }}</th>
                                    <th>{{ __("Details") }}</th>
                                    <th>{{ __("Date") }}</th>
                                    <th>{{ __("Time") }}</th>
                                    <th>{{ __("Options") }}</th>
                                </tr>
                                @foreach($order->tracks as $track)
            
                                <tr data-id="{{ $track->id }}">
                                    <td width="30%" class="t-title">{{ $track->title }}</td>
                                    <td width="30%" class="t-text">{{ $track->text }}</td>
                                    <td>{{  date('Y-m-d',strtotime($track->created_at)) }}</td>
                                    <td>{{  date('h:i:s:a',strtotime($track->created_at)) }}</td>
                                    <td>
                                        <div>
                                            <a data-href="{{ route('admin-order-track-update',$track->id) }}" class="track-edit btn btn-primary"> <i class="fas fa-edit"></i>Edit</a>
                                            <a href="javascript:;" data-href="{{ route('admin-order-track-delete',$track->id) }}" class="track-delete btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection