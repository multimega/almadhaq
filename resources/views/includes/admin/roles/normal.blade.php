@if(Auth::guard('admin')->user()->role_id != 0)

@if(Auth::guard('admin')->user()->sectionCheck('orders'))

<li>
    <a href="{{ route('admin-order-index') }}" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false"><i class="fas fa-hand-holding-usd"></i>{{ __('Orders') }} </a>
</li>

@endif

@if(Auth::guard('admin')->user()->sectionCheck('products'))

    <li>
        <a href="{{ route('admin-prod-index') }}" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false"><i class="fas fa-box"></i>{{ __('Products') }}</a>
    </li>

@endif


@if(Auth::guard('admin')->user()->sectionCheck('affilate_products'))

    <li>
        <a href="#affiliateprod" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false"><i class="icofont-cart"></i>{{ __('Affiliate Products') }}</a>
    </li>

@endif


@if(Auth::guard('admin')->user()->sectionCheck('customers'))

    <li>
        <a href="#menu3" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false"><i class="icofont-user"></i>{{ __('Customers') }}</a>
    </li>

@endif


@if(Auth::guard('admin')->user()->sectionCheck('vendors'))

    <li>
        <a href="{{ route('admin-vendor-index') }}" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false"><i class="fas fa-store-alt"></i>{{ __('Vendors') }}</a>
    </li>

@endif


@if(Auth::guard('admin')->user()->sectionCheck('bulk_product_upload'))

    <li><a href="{{ route('admin-prod-import') }}"><i class="fas fa-upload"></i>{{ __('Bulk Product Upload') }}</a></li>

@endif

@if(Auth::guard('admin')->user()->sectionCheck('product_discussion'))

    <li>
        <a href="#menu4" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false"><i class="icofont-speech-comments"></i>{{ __('Product Discussion') }}</a>
    </li>

@endif

@if(Auth::guard('admin')->user()->sectionCheck('set_coupons'))

    <li>
        <a href="{{ route('admin-coupon-index') }}" class=" wave-effect"><i class="fas fa-percentage"></i>{{ __('Set Coupons') }}</a>
    </li>

@endif


@if(Auth::guard('admin')->user()->sectionCheck('messages'))

    <li>
        <a href="#msg" class="accordion-toggle wave-effect" data-toggle="collapse" aria-expanded="false"><i class="fas fa-fw fa-newspaper"></i>{{ __('Messages') }}</a>
    </li>

@endif


@endif