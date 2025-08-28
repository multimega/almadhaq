@extends('layouts.admin')
@section('styles')
<style type="text/css">
    .order-table-wrap table#example2 {
        margin: 10px 20px;
    }

    th {
        white-space: nowrap;
        font-size: 14px;
    }

    .editable-field {
        cursor: pointer;
        position: relative;
    }

    .editable-field:hover {
        background-color: #f8f9fa;
        border-radius: 4px;
        padding: 2px 4px;
    }

    .edit-input {
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 4px 8px;
        font-size: 14px;
    }

    .edit-textarea {
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 4px 8px;
        font-size: 14px;
        resize: vertical;
        min-height: 60px;
    }

    .edit-buttons {
        margin-top: 5px;
    }

    .edit-buttons .btn {
        padding: 2px 8px;
        font-size: 12px;
        margin-right: 5px;
    }
</style>
@endsection


@section('content')


<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">

            @if (Session::has('flash_message'))
            <div class="alert alert-success text-center"><em> {!! session('flash_message') !!}</em></div>
            @endif
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Order Details') }} <a class="add-btn" href="javascript:history.back();"><i
                            class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="javascript:;">{{ __('Orders') }}</a>
                    </li>
                    <li>
                        <a href="javascript:;">{{ __('Order Details') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="order-table-wrap">
        @include('includes.admin.form-both')
        <div class="row">

            <div class="col-lg-6">
                <div class="special-box">
                    <div class="heading-area">
                        <h4 class="title">
                            {{ __('Order Details') }}
                        </h4>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th class="45%" width="45%">{{ __('Order ID') }}</th>
                                    <td width="10%">:</td>
                                    <td class="45%" width="45%">{{ $order->order_number }}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Total Product') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ $order->totalQty }}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Total Cost') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">
                                        {{ $order->currency_sign }}{{ round($order->pay_amount, 2) *
                                        $order->currency_value }}
                                    </td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Ordered Date') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ date('d-M-Y h:i A', strtotime($order->created_at)) }}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Payment Method') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">{{ $order->method }}</td>
                                </tr>

                                @if ($order->method != 'Cash On Delivery')
                                @if ($order->method == 'Stripe')
                                <tr>
                                    <th width="45%">{{ $order->method }} {{ __('Charge ID') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%" style="word-break: break-all;">{{ $order->charge_id }}
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th width="45%">{{ $order->method }} {{ __('Transaction ID') }}</th>
                                    <td width="10%">:</td>
                                    @if ($order->method == 'tap')
                                    <td width="45%" style="word-break: break-all;">
                                        {{ $order->tap_order_id }}</td>
                                    @else
                                    <td width="45%" style="word-break: break-all;">{{ $order->txnid }}</td>
                                    @endif
                                </tr>
                                @endif

                                <tr>
                                    <th width="45%">{{ __('Payment Status') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">
                                        @if (in_array($order->payment_status, ['Pending', 'Failure', 'Cancelled']))
                                        <span class='badge bg-danger py-2 ms-2'>Unpaid</span>
                                        @else
                                        <span class='badge bg-success py-2 ms-2'>Paid</span>
                                        @endif
                                    </td>
                                </tr>
                                {{--
                                <tr>
                                    <th width="45%">{{ __('Order Note') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{ $order->order_note }}</td>
                                </tr> --}}

                                <tr>
                                    <th width="45%">{{ __('Order Note') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">
                                        <div class="editable-field" data-field="order_note"
                                            data-value="{{ $order->order_note }}">
                                            <span class="display-value">{{ $order->order_note ?: __('No note provided')
                                                }}</span>
                                            <div class="edit-form" style="display: none;">
                                                <textarea class="edit-textarea"
                                                    rows="3">{{ $order->order_note }}</textarea>
                                                <div class="edit-buttons">
                                                    <button class="btn btn-success btn-sm save-btn">{{ __('Save')
                                                        }}</button>
                                                    <button class="btn btn-secondary btn-sm cancel-btn">{{ __('Cancel')
                                                        }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                @if ($order->scheduled_delivery_date && $order->scheduled_delivery_start_time &&
                                $order->scheduled_delivery_end_time)
                                <tr>
                                    <th width="45%">{{ __('Scheduled Delivery') }}</th>
                                    <td width="10%">:</td>
                                    <td width="45%">

                                        @php
                                        $dayName = \Carbon\Carbon::parse(
                                        $order->scheduled_delivery_date,
                                        )->translatedFormat('l');
                                        $startTime = \Carbon\Carbon::parse(
                                        $order->scheduled_delivery_start_time,
                                        )->format('h:i A');
                                        $endTime = \Carbon\Carbon::parse(
                                        $order->scheduled_delivery_end_time,
                                        )->format('h:i A');
                                        @endphp
                                        {{ __('التوصيل يوم') }} {{ $dayName }} {{ __('من') }}
                                        {{ $startTime }} {{ __('إلى') }} {{ $endTime }}
                                    </td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="footer-area">
                        <a href="{{ route('admin-order-invoice', $order->id) }}" class="mybtn1"><i
                                class="fas fa-eye"></i> {{ __('View Invoice') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="special-box">
                    <div class="heading-area">
                        <h4 class="title">
                            {{ __('Billing Details') }}
                        </h4>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width="45%">{{ __('Name') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{ $order->customer_name }}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Email') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{ $order->customer_email }}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('Phone') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{ $order->customer_phone }}</td>
                                </tr>
                                {{-- <tr>
                                    <th width="45%">{{ __('Address') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{ $order->customer_address }}</td>
                                </tr> --}}

                                <tr>
                                    <th width="45%">{{ __('Address') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">
                                        <div class="editable-field" data-field="customer_address"
                                            data-value="{{ $order->customer_address ?? '' }}">
                                            <span class="display-value">{{ $order->customer_address ?: __('No address provided') }}</span>
                                            <div class="edit-form" style="display: none;">
                                                <textarea class="edit-textarea"
                                                    rows="3">{{ $order->customer_address ?? '' }}</textarea>
                                                <div class="edit-buttons">
                                                    <button class="btn btn-success btn-sm save-btn">{{ __('Save')
                                                        }}</button>
                                                    <button class="btn btn-secondary btn-sm cancel-btn">{{ __('Cancel')
                                                        }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th width="45%">{{ __('Country') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{ $order->customer_country }}</td>
                                </tr>
                                <tr>
                                    <th width="45%">{{ __('City') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{ $order->customer_city }}</td>
                                </tr>

                                 <tr>
                                    <th width="45%">{{ __('Area') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{ $order->area }}</td>
                                </tr>

                                 <tr>
                                    <th width="45%">{{ __('Building Number') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{ $order->building_number }}</td>
                                </tr>

                                <tr>
                                    <th width="45%">{{ __('Postal Code') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{ $order->customer_zip }}</td>
                                </tr>
                                @if ($order->coupon_code != null)
                                <tr>
                                    <th width="45%">{{ __('Coupon Code') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{ $order->coupon_code }}</td>
                                </tr>
                                @endif
                                @if ($order->coupon_discount != null)
                                <tr>
                                    <th width="45%">{{ __('Coupon Discount') }}</th>
                                    <th width="10%">:</th>
                                    @if ($gs->currency_format == 0)
                                    <td width="45%">
                                        {{ $order->currency_sign }}{{ $order->coupon_discount }}</td>
                                    @else
                                    <td width="45%">
                                        {{ $order->coupon_discount }}{{ $order->currency_sign }}</td>
                                    @endif
                                </tr>
                                @endif

                                @if ($order->wallet != 0)
                                <tr>
                                    <th width="45%">{{ __('Wallet Discount') }}</th>
                                    <th width="10%">:</th>
                                    @if ($gs->currency_format == 0)
                                    <td width="45%">{{ $order->currency_sign }}{{ $order->wallet }}</td>
                                    @else
                                    <td width="45%">{{ $order->wallet }}{{ $order->currency_sign }}</td>
                                    @endif
                                </tr>
                                @endif
                                @if ($order->affilate_user != null)
                                <tr>
                                    <th width="45%">{{ __('Affilate User') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{ $order->affilate_user }}</td>
                                </tr>
                                @endif
                                @if ($order->affilate_charge != null)
                                <tr>
                                    <th width="45%">{{ __('Affilate Charge') }}</th>
                                    <th width="10%">:</th>
                                    @if ($gs->currency_format == 0)
                                    <td width="45%">
                                        {{ $order->currency_sign }}{{ $order->affilate_charge }}</td>
                                    @else
                                    <td width="45%">
                                        {{ $order->affilate_charge }}{{ $order->currency_sign }}</td>
                                    @endif
                                </tr>
                                @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if ($order->dp == 0)
            <div class="col-lg-8">
                <div class="special-box">
                    <div class="heading-area">
                        <h4 class="title">
                            {{ __('Shipping Details') }}
                        </h4>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table">
                            <tbody>

                                @if ($order->shipment_id == 1 && $order->status == 'processing')
                                <tr>
                                    <th width="45%"><strong>Order Number Fastlo</strong></th>
                                    <th width="10%">:</th>

                                    <td width="45%"><a
                                            href="{{ route('admin-order-fastlooshow', $order->company_fastlo_api) }}">{{
                                            $order->company_fastlo_api }}
                                    </td>
                                    <a class="btn btn-success"
                                        href="{{ url('admin/deletss_api/' . $order->company_fastlo_api) }}">Delete
                                        fastlo shipment</a></td>

                                </tr>
                                @endif


                                @if ($order->shipment_id == 6 && $order->status == 'processing')
                                <tr>
                                    <th width="45%"><strong></strong>ABS Number</th>
                                    <th width="10%">:</th>
                                    <td width="45%"><a class="btn btn-success"
                                            href="{{ route('admin-order-abs', $order->Awb) }}">{{ $order->Awb }}</a>
                                    </td>

                                </tr>
                                @endif

                                @if ($order->shipment_id == 7 && $order->status == 'processing')
                                <tr>
                                    <th width="45%"><strong></strong>Mylerz Barcode</th>
                                    <th width="10%">:</th>
                                    <td width="45%"><a class="btn btn-success"
                                            href="{{ route('admin-order-mylerz', $order->barcod) }}">{{ $order->barcod
                                            }}</a>
                                    </td>
                                    <td width="45%"><a class="btn btn-success"
                                            href="{{ route('admin-mylerz-index', $order->barcod) }}">
                                            PDF </a></td>

                                </tr>
                                @endif

                                @if ($order->shipment_id == 2 && $order->status == 'processing')
                                <tr>
                                    <th width="45%"><strong></strong>Aramex Track number</th>
                                    <th width="10%">:</th>
                                    <td width="45%"><a
                                            href="{{ url('aramexdetailz/' . $order->aramex_api_numbeer) }}">{{
                                            $order->aramex_api_numbeer }}</a>
                                    </td>

                                </tr>
                                @endif
                                @if ($order->shipment_id == 2 && $order->status == 'on delivery')
                                <tr>
                                    <th width="45%"><strong></strong>Aramex pickup id</th>
                                    <th width="10%">:</th>
                                    <td width="45%"><a href="{{ route('tracks_aramexx', $order->pickuptrack_api) }}">{{
                                            $order->pickuptrack_api }}</a>
                                        <a class="btn btn-success"
                                            href="{{ route('aramexcancell', $order->id_api_aramex) }}">cancel
                                            pickup</a>
                                    </td>
                                </tr>
                                @endif
                                @if ($order->shipment_id == 4 && $order->status == 'processing')
                                <tr>
                                    <th width="45%"><strong></strong>Fedex Serial Number</th>
                                    <th width="10%">:</th>
                                    <td><a class="btn sendEmail" href="{{ route('admin-order', $order->serial) }}">
                                            Status</a></td>
                                    &nbsp;&nbsp;
                                    <td><a class="btn btn-success"
                                            href="/admin/generate_pdf?serial={{ $order->serial }}&id={{ $order->id }}">PDF</a>
                                    </td>
                                    {{-- <td width="45%"><a class="btn sendEmail" target="_blank"
                                            href="{{route('admin-order-printPolice',$order->id)}}">View</a></td> --}}

                                </tr>
                                @endif

                                @if ($order->shipment_id == 4 && $order->status == 'on delivery')
                                <tr>
                                    <th width="45%"><strong></strong>Fedex Serial Number</th>
                                    <th width="10%">:</th>
                                    <td width="45%"><a class="btn btn-success"
                                            href="{{ route('admin-order', $order->serial) }}">{{ $order->serial }}</a>
                                    </td>


                                </tr>

                                <tr>
                                    <th width="45%"><strong></strong>Fedex pickup id</th>
                                    <th width="10%">:</th>
                                    <td width="45%"><a class="btn btn-success">{{ $order->fedex_pic_api }}</a></td>

                                </tr>
                                @endif
                                @if ($order->shipment_id == 6 && $order->status == 'on delivery')
                                <tr>
                                    <th width="45%"><strong></strong>Abs Pickup</th>
                                    <th width="10%">:</th>
                                    <td width="45%"><a class="btn btn-success">{{ $order->pickup_id }}</a>
                                    </td>
                                </tr>
                                @endif

                                @if ($order->shipment_id == 4 && $order->status == 'completed')
                                <tr>
                                    <!--<td><a class="btn btn-success" href="/admin/generate_pdf?serial={{ $order->serial }}&id={{ $order->id }}">PDF</a></td>-->

                                    @if ($order->serial != '')
                                    <th width="45%"><strong></strong>Fedex Serial Number</th>
                                    <th width="10%">:</th>
                                    <td width="45%"><a class="btn btn-success"
                                            href="{{ route('admin-order', $order->serial) }}">{{ $order->serial }}</a>
                                    </td>
                                    <td width="45%"><a class="btn btn-success"
                                            href="{{ route('admin-order', $order->serial) }}">Status</a>
                                    </td>
                                    @endif
                                    @if ($order->fedex_pic_api != '')
                                    <th width="45%"><strong></strong>Fedex pickup id</th>
                                    <th width="10%">:</th>

                                    <td width="45%"><a class="btn btn-success">{{ $order->fedex_pic_api }}</a></td>
                                    @endif

                                </tr>
                                @endif




                                @if ($order->shipping == 'pickup')
                                <tr>
                                    <th width="45%"><strong>{{ __('Pickup Location') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{ $order->pickup_location }}</td>
                                </tr>
                                @else
                                <tr>
                                    <th width="45%"><strong>{{ __('Name') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td>{{ $order->shipping_name == null ? $order->customer_name : $order->shipping_name
                                        }}
                                    </td>
                                </tr>
                                <tr>
                                    <th width="45%"><strong>{{ __('Email') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td width="45%">
                                        {{ $order->shipping_email == null ? $order->customer_email :
                                        $order->shipping_email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th width="45%"><strong>{{ __('Phone') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td width="45%">
                                        {{ $order->shipping_phone == null ? $order->customer_phone :
                                        $order->shipping_phone }}
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <th width="45%"><strong>{{ __('Address') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td width="45%">
                                        {{ $order->shipping_address == null ? $order->customer_address :
                                        $order->shipping_address }}
                                    </td>
                                </tr> --}}

                                <tr>
                                    <th width="45%"><strong>{{ __('Address') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td width="45%">
                                        <div class="editable-field" data-field="shipping_address"
                                            data-value="{{ $order->shipping_address ?: ($order->customer_address ?: '') }}">
                                            <span class="display-value">
                                                {{ $order->shipping_address ?: ($order->customer_address ?: __('No address provided')) }}
                                            </span>
                                            <div class="edit-form" style="display: none;">
                                                <textarea class="edit-textarea"
                                                    rows="3">{{ $order->shipping_address ?: ($order->customer_address ?: '') }}</textarea>
                                                <div class="edit-buttons">
                                                    <button class="btn btn-success btn-sm save-btn">{{ __('Save')
                                                        }}</button>
                                                    <button class="btn btn-secondary btn-sm cancel-btn">{{ __('Cancel')
                                                        }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th width="45%"><strong>{{ __('Country') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td width="45%">
                                        {{ $order->shipping_country == null ? $order->customer_country :
                                        $order->shipping_country }}
                                    </td>
                                </tr>
                                <tr>
                                    <th width="45%"><strong>{{ __('City') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td width="45%">
                                        {{ $order->shipping_city == null ? $order->customer_city : $order->shipping_city
                                        }}
                                    </td>
                                </tr>

                                
                                 <tr>
                                    <th width="45%">{{ __('Area') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{ $order->area }}</td>
                                </tr>

                                 <tr>
                                    <th width="45%">{{ __('Building Number') }}</th>
                                    <th width="10%">:</th>
                                    <td width="45%">{{ $order->building_number }}</td>
                                </tr>
                                
                                <tr>
                                    <th width="45%"><strong>{{ __('Postal Code') }}:</strong></th>
                                    <th width="10%">:</th>
                                    <td width="45%">
                                        {{ $order->shipping_zip == null ? $order->customer_zip : $order->shipping_zip }}
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>



        <div class="row">
            <div class="col-lg-12 order-details-table">
                <div class="mr-table">
                    <h4 class="title">{{ __('Products Ordered') }}</h4>
                    <div class="table-responsiv">
                        <table id="example2" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                <tr>
                                    <th width="10%">{{ __('Product ID#') }}</th>
                                    <th>{{ __('Shop Name') }}</th>
                                    <th>{{ __('Vendor Status') }}</th>
                                    <th>{{ __('Product Title') }}</th>
                                    <th width="20%">{{ __('Details') }}</th>
                                    <th width="10%">{{ __('Total Price') }}</th>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart->items as $key => $product)
                                <tr>

                                    <td><input type="hidden" value="{{ $key }}">{{ $product['item']['id'] }}</td>

                                    <td>
                                        @if ($product['item']['user_id'] != 0)
                                        @php
                                        $user = App\Models\User::find($product['item']['user_id']);
                                        @endphp
                                        @if (isset($user))
                                        <a target="_blank" href="{{ route('admin-vendor-show', $user->id) }}">{{
                                            $user->shop_name }}</a>
                                        @else
                                        {{ __('Vendor Removed') }}
                                        @endif
                                        @else
                                        <a href="javascript:;">{{ App\Models\Admin::find(1)->shop_name }}</a>
                                        @endif

                                    </td>
                                    <td>
                                        @if ($product['item']['user_id'] != 0)
                                        @php
                                        $user = App\Models\VendorOrder::where(
                                        'order_id',
                                        '=',
                                        $order->id,
                                        )
                                        ->where('user_id', '=', $product['item']['user_id'])
                                        ->first();
                                        @endphp

                                        @if ($order->dp == 1 && $order->payment_status == 'Completed')
                                        <span class="badge bg-success py-2 ms-2">{{ __('Completed') }}</span>
                                        @else
                                        @if ($user->status == 'pending')
                                        <span class="badge bg-warning py-2 ms-2">{{ ucwords($user->status) }}</span>
                                        @elseif($user->status == 'processing')
                                        <span class="badge bg-info py-2 ms-2">{{ ucwords($user->status) }}</span>
                                        @elseif($user->status == 'on delivery')
                                        <span class="badge bg-primary py-2 ms-2">{{ ucwords($user->status) }}</span>
                                        @elseif($user->status == 'completed')
                                        <span class="badge bg-success py-2 ms-2">{{ ucwords($user->status) }}</span>
                                        @elseif($user->status == 'declined')
                                        <span class="badge bg-danger py-2 ms-2">{{ ucwords($user->status) }}</span>
                                        @endif
                                        @endif
                                        @endif
                                    </td>


                                    <td>
                                        <input type="hidden" value="{{ $product['license'] }}">

                                        @if ($product['item']['user_id'] != 0)
                                        @php
                                        $user = App\Models\User::find($product['item']['user_id']);
                                        @endphp
                                        @if (isset($user))
                                        <a target="_blank"
                                            href="{{ route('front.product', ['lang' => $lang, 'slug' => $product['item']['slug']]) }}">
                                            {{ strlen($product['item']['name']) > 30 ? substr($product['item']['name'],
                                            0, 30) . '...' : $product['item']['name'] }}
                                        </a>
                                        @else
                                        <a target="_blank"
                                            href="{{ route('front.product', ['lang' => $lang, 'slug' => $product['item']['slug']]) }}">
                                            {{ strlen($product['item']['name']) > 30 ? substr($product['item']['name'],
                                            0, 30) . '...' : $product['item']['name'] }}
                                        </a>
                                        @endif
                                        @else
                                        <a target="_blank"
                                            href="{{ route('front.product', ['lang' => $lang, 'slug' => $product['item']['slug']]) }}">
                                            {{ strlen($product['item']['name']) > 30 ? substr($product['item']['name'],
                                            0, 30) . '...' : $product['item']['name'] }}
                                        </a>
                                        @endif


                                        @if ($product['license'] != '')
                                        <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete"
                                            class="btn btn-info product-btn" id="license" style="padding: 5px 12px;"><i
                                                class="fa fa-eye"></i> {{ __('View License') }}</a>
                                        @endif

                                    </td>
                                    <td>
                                        @if ($product['size'])
                                        <p>
                                            <strong>{{ __('Size') }} :</strong> {{ $product['size'] }}
                                        </p>
                                        @endif
                                        @if ($product['color'])
                                        <p>
                                            <strong>{{ __('color') }} :</strong> <span
                                                style="width: 40px; height: 20px; display: block; background: #{{ $product['color'] }};"></span>
                                        </p>
                                        @endif
                                        <p>
                                            <strong>{{ __('Price') }} :</strong>
                                            {{ $order->currency_sign }}{{ round($product['item']['price'] *
                                            $order->currency_value, 2) }}
                                        </p>
                                        <p>
                                            <strong>{{ __('Qty') }} :</strong> {{ $product['qty'] }}
                                            {{ $product['item']['measure'] }}
                                        </p>
                                        @if (!empty($product['keys']))
                                        @foreach (array_combine(explode(',', $product['keys']), explode(',',
                                        $product['values'])) as $key => $value)
                                        <p>

                                            <b>{{ ucwords(str_replace('_', ' ', $key)) }} : </b>
                                            {{ $value }}

                                        </p>
                                        @endforeach
                                        @endif




                                    </td>

                                    <td>{{ $order->currency_sign }}{{ round($product['price'] * $order->currency_value,
                                        2) }}
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center mt-2">
                <a class="btn sendEmail send" href="javascript:;" class="send" data-email="{{ $order->customer_email }}"
                    data-toggle="modal" data-target="#vendorform">
                    <i class="fa fa-send"></i> {{ __('Send Email') }}
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Main Content Area End -->
</div>
</div>


</div>

{{-- LICENSE MODAL --}}

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header d-block text-center">
                <h4 class="modal-title d-inline-block">{{ __('License Key') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <p class="text-center">{{ __('The Licenes Key is') }} : <span id="key"></span> <a href="javascript:;"
                        id="license-edit">{{ __('Edit License') }}</a><a href="javascript:;" id="license-cancel"
                        class="showbox">{{ __('Cancel') }}</a></p>
                <form method="POST" action="{{ route('admin-order-license', $order->id) }}" id="edit-license"
                    style="display: none;">
                    {{ csrf_field() }}
                    <input type="hidden" name="license_key" id="license-key" value="">
                    <div class="form-group text-center">
                        <input type="text" name="license" placeholder="{{ __('Enter New License Key') }}"
                            style="width: 40%; border: none;" required=""><input type="submit" name="submit"
                            class="btn btn-primary" style="border-radius: 0; padding: 2px; margin-bottom: 2px;">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>


{{-- LICENSE MODAL ENDS --}}

{{-- MESSAGE MODAL --}}
<div class="sub-categori">
    <div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="vendorformLabel">{{ __('Send Email') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="contact-form">
                                    <form id="emailreply">
                                        {{ csrf_field() }}
                                        <ul>
                                            <li>
                                                <input type="email" class="input-field eml-val" id="eml" name="to"
                                                    placeholder="{{ __('Email') }} *" value="" required="">
                                            </li>
                                            <li>
                                                <input type="text" class="input-field" id="subj" name="subject"
                                                    placeholder="{{ __('Subject') }} *" required="">
                                            </li>
                                            <li>
                                                <textarea class="input-field textarea" name="message" id="msg"
                                                    placeholder="{{ __('Your Message') }} *" required=""></textarea>
                                            </li>
                                        </ul>
                                        <button class="submit-btn" id="emlsub" type="submit">{{ __('Send Email')
                                            }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MESSAGE MODAL ENDS --}}

{{-- ORDER MODAL --}}

<div class="modal fade" id="confirm-delete2" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="submit-loader">
                <img src="{{ asset('assets/images/' . $gs->admin_loader) }}" alt="">
            </div>
            <div class="modal-header d-block text-center">
                <h4 class="modal-title d-inline-block">{{ __('Update Status') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p class="text-center">{{ __("You are about to update the order's status.") }}</p>
                <p class="text-center">{{ __('Do you want to proceed?') }}</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-success btn-ok order-btn">{{ __('Proceed') }}</a>
            </div>

        </div>
    </div>
</div>

{{-- ORDER MODAL ENDS --}}


@endsection


@section('scripts')

<script type="text/javascript">
    // Inline editing functionality
$(document).ready(function() {
    // Click to edit
    $(document).on('click', '.editable-field .display-value', function() {
        var container = $(this).closest('.editable-field');
        container.find('.display-value').hide();
        container.find('.edit-form').show();
        container.find('textarea').focus();
    });

    // Cancel editing
    $(document).on('click', '.cancel-btn', function() {
        var container = $(this).closest('.editable-field');
        var originalValue = container.data('value');
        container.find('textarea').val(originalValue);
        container.find('.edit-form').hide();
        container.find('.display-value').show();
    });

    // Save changes
    $(document).on('click', '.save-btn', function() {
        var container = $(this).closest('.editable-field');
        var field = container.data('field');
        var newValue = container.find('textarea').val();
        var saveBtn = $(this);
        
        // Disable save button during request
        saveBtn.prop('disabled', true).text('{{ __("Saving...") }}');
        
        // AJAX request
        $.ajax({
            url: '{{ route("admin.order.update-field", $order->id) }}',
            method: 'POST',
            data: {
                '_token': '{{ csrf_token() }}',
                'field': field,
                'value': newValue
            },
            success: function(response) {
                if (response.success) {
                    // Update display value
                    // container.find('.display-value').text(newValue || '{{ __("No note provided") }}');
                    // Update display value based on field type
                    var displayText = newValue;
                    if (!newValue) {
                        if (field === 'customer_address' || field === 'shipping_address') {
                            displayText = '{{ __("No address provided") }}';
                        } else if (field === 'order_note') {
                            displayText = '{{ __("No note provided") }}';
                        }
                    }
                    container.find('.display-value').text(displayText);

                    container.data('value', newValue);
                    
                    // Hide edit form
                    container.find('.edit-form').hide();
                    container.find('.display-value').show();
                    
                    // Show success message
                    $.notify(response.message, 'success');
                } else {
                    $.notify(response.message || '{{ __("Error updating field") }}', 'error');
                }
            },
            error: function(xhr) {
                var errorMessage = '{{ __("Error updating field") }}';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                $.notify(errorMessage, 'error');
            },
            complete: function() {
                // Re-enable save button
                saveBtn.prop('disabled', false).text('{{ __("Save") }}');
            }
        });
    });

    // Press Escape to cancel
    $(document).on('keydown', '.edit-textarea', function(e) {
        if (e.key === 'Escape') {
            $(this).closest('.editable-field').find('.cancel-btn').click();
        }
    });
});
</script>

<script type="text/javascript">
    $('#example2').dataTable({
            "ordering": false,
            'lengthChange': false,
            'searching': false,
            'ordering': false,
            'info': false,
            'autoWidth': false,
            'responsive': true
        });
</script>

<script type="text/javascript">
    $(document).on('click', '#license', function(e) {
            var id = $(this).parent().find('input[type=hidden]').val();
            var key = $(this).parent().parent().find('input[type=hidden]').val();
            $('#key').html(id);
            $('#license-key').val(key);
        });
        $(document).on('click', '#license-edit', function(e) {
            $(this).hide();
            $('#edit-license').show();
            $('#license-cancel').show();
        });
        $(document).on('click', '#license-cancel', function(e) {
            $(this).hide();
            $('#edit-license').hide();
            $('#license-edit').show();
        });

        $(document).on('submit', '#edit-license', function(e) {
            e.preventDefault();
            $('button#license-btn').prop('disabled', true);
            $.ajax({
                method: "POST",
                url: $(this).prop('action'),
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if ((data.errors)) {
                        for (var error in data.errors) {
                            $.notify('<li>' + data.errors[error] + '</li>', 'error');
                        }
                    } else {
                        $.notify(data, 'success');
                        $('button#license-btn').prop('disabled', false);
                        $('#confirm-delete').modal('toggle');

                    }
                }
            });
        });
</script>
@endsection