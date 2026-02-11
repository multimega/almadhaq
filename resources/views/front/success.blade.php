@extends('layouts.front')

@section('styles')
<style>
    .order-confirmation-section {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 70vh;
    }

    .confirmation-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid #e9ecef;
    }

    .success-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #28a745, #20c997);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .success-icon i {
        font-size: 40px;
        color: white;
    }

    .confirmation-title {
        color: #28a745;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .confirmation-subtitle {
        color: #6c757d;
        font-size: 16px;
    }

    .order-details-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 20px;
        border-left: 4px solid #007bff;
    }

    .order-details-title {
        color: #495057;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .order-info {
        color: #6c757d;
    }

    .whatsapp-section {
        background: linear-gradient(135deg, #25d366, #128c7e);
        border-radius: 15px;
        padding: 30px;
        color: white;
        text-align: center;
    }

    .whatsapp-icon {
        font-size: 48px;
        margin-bottom: 15px;
        color: white;
    }

    .whatsapp-header h4 {
        color: white;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .whatsapp-description {
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 0;
    }

    .status-message {
        padding: 12px 20px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-weight: 500;
    }

    .loading-message {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .success-message {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .error-message {
        background: rgba(220, 53, 69, 0.9);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-whatsapp {
        background: white;
        color: #25d366;
        border: 2px solid white;
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 50px;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .btn-whatsapp:hover {
        background: rgba(255, 255, 255, 0.9);
        color: #128c7e;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .help-section {
        border-top: 1px solid #e9ecef;
    }

    .badge-success {
        background-color: #28a745;
    }

    @media (max-width: 768px) {
        .confirmation-card {
            padding: 25px 20px;
            margin: 0 15px;
        }

        .success-icon {
            width: 60px;
            height: 60px;
        }

        .success-icon i {
            font-size: 30px;
        }

        .whatsapp-section {
            padding: 20px;
        }

        .whatsapp-icon {
            font-size: 36px;
        }
    }
</style>
@endsection

@section('content')
@php
$slang = Session::get('language');
$lang = DB::table('languages')->where('is_default', '=', 1)->first();
@endphp

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="pages">
                    <li>
                        <a href="{{ route('front.index', $sign) }}">
                            {{ $langg->lang17 }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('payment.return') }}">
                            {{ $langg->lang169 }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="order-confirmation-section py-5">
    <input type="hidden" id="order_id" value="{{ $order->id }}">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="confirmation-card">

                    <!-- WhatsApp Section -->
                    <div class="whatsapp-section">
                        <div class="whatsapp-header text-center mb-3">
                            <i class="fab fa-whatsapp whatsapp-icon"></i>
                            <h4>{{ __('Complete Your Order on WhatsApp') }}</h4>
                            <p class="whatsapp-description">
                                {{ __('We will now redirect you to WhatsApp to finalize your order details and arrange
                                delivery.') }}
                            </p>
                        </div>

                        <!-- Status Messages -->
                        <div id="status-messages">
                            <div id="loading-message" class="status-message loading-message">
                                <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                                {{ __('Preparing your WhatsApp message...') }}
                            </div>

                            <div id="success-message" class="status-message success-message" style="display: none;">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ __('WhatsApp opened successfully! If it didn\'t open automatically, use the button
                                below.') }}
                            </div>

                            <div id="error-message" class="status-message error-message" style="display: none;">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <span id="error-text">{{ __('Unable to open WhatsApp automatically. Please use the
                                    button below.') }}</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons text-center mt-4">
                            <button id="whatsapp-btn" class="btn btn-whatsapp btn-lg" style="display: none;">
                                <i class="fab fa-whatsapp me-2"></i>
                                {{ __('Open WhatsApp') }}
                            </button>

                            <div class="mt-3">
                                <a href="{{ route('front.index', $sign) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-home me-2"></i>
                                    {{ __('Return to Home') }}
                                </a>

                     
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')

<!-- GTM Data Layer - Purchase Event -->
<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
    dataLayer.push({
        event: "purchase",
        ecommerce: {
            transaction_id: "{{ $order->order_number }}",
            value: {{ $order->pay_amount }},
            tax: {{ $order->tax ?? 0 }},
            shipping: {{ $order->shipping_cost ?? 0 }},
            currency: "{{ $order->currency_sign ?? 'USD' }}",
            @if(!empty($order->coupon_code))
            coupon: "{{ $order->coupon_code }}",
            @endif
            items: [
                @php $purchaseIndex = 0; @endphp
                @if($order->cart)
                    @php $cart = json_decode($order->cart, true); @endphp
                    @if(isset($cart['items']))
                        @foreach($cart['items'] as $item)
                            @if($purchaseIndex > 0),@endif
                            {
                                item_id: "{{ $item['item']['sku'] ?? $item['item']['id'] }}",
                                item_name: "@if(!$slang)@if($lang->id == 2){{ $item['item']['name_ar'] ?? $item['item']['name'] }}@else{{ $item['item']['name'] }}@endif @else @if($slang == 2){{ $item['item']['name_ar'] ?? $item['item']['name'] }}@else{{ $item['item']['name'] }}@endif @endif",
                                affiliation: "{{ $gs->title ?? 'Store' }}",
                                price: {{ $item['price'] }},
                                quantity: {{ $item['qty'] }}
                            }
                            @php $purchaseIndex++; @endphp
                        @endforeach
                    @endif
                @endif
            ]
        }
    });
    console.log('GTM purchase event fired for order: {{ $order->order_number }}');
    // Fire Snap Pixel PURCHASE
    if (typeof snaptr === 'function') {
        var snapItemIds = [];
        @if($order->cart)
            @php $orderCart = json_decode($order->cart, true); @endphp
            @if(!empty($orderCart['items']))
                @foreach($orderCart['items'] as $item)
                    snapItemIds.push("{{ $item['item']['sku'] ?? $item['item']['id'] }}");
                @endforeach
            @endif
        @endif
        snaptr('track', 'PURCHASE', {
            price: {{ $order->pay_amount }},
            currency: "{{ $order->currency_sign ?? 'USD' }}",
            transaction_id: "{{ $order->order_number }}",
            item_ids: snapItemIds,
            number_items: snapItemIds.length
        });
        console.log('Snap Pixel PURCHASE fired for order: {{ $order->order_number }}');
    }
</script>
<!-- End GTM Data Layer - Purchase Event -->

<script>
   $(document).ready(function() {
    var orderId = $('#order_id').val();
    var whatsappUrl = '';
    var retryCount = 0;
    var maxRetries = 3;
    var isOpening = false; // Prevent multiple simultaneous calls
    
    function fetchWhatsAppMessage() {
        $.ajax({
            url: '/checkout/order/' + orderId + '/get-whatsapp-message',
            method: 'GET',
            dataType: 'json',
            timeout: 10000,
            success: function(response) {
                if (response.whatsapp_url) {
                    whatsappUrl = response.whatsapp_url;
                    handleWhatsAppSuccess();
                } else {
                    handleWhatsAppError('{{ __("Invalid WhatsApp URL received") }}');
                }
            },
            error: function(xhr, status, error) {
                var errorMessage = '{{ __("Error occurred while preparing WhatsApp message") }}';
                
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMessage = xhr.responseJSON.error;
                } else if (status === 'timeout') {
                    errorMessage = '{{ __("Request timed out. Please try again.") }}';
                } else if (xhr.status === 404) {
                    errorMessage = '{{ __("Order not found") }}';
                } else if (xhr.status === 500) {
                    errorMessage = '{{ __("Server error. Please try again later.") }}';
                }
                
                if (retryCount < maxRetries && (status === 'timeout' || xhr.status >= 500)) {
                    retryCount++;
                    setTimeout(function() {
                        $('#error-text').text('{{ __("Retrying... Attempt") }} ' + retryCount + ' {{ __("of") }} ' + maxRetries);
                        fetchWhatsAppMessage();
                    }, 1000);
                } else {
                    handleWhatsAppError(errorMessage);
                }
            }
        });
    }
    
    function handleWhatsAppSuccess() {
        $('#loading-message').hide();
        $('#success-message').show();
        $('#whatsapp-btn').show().off('click').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            openWhatsApp();
        });
        
        // Auto-open WhatsApp after 2 seconds
        setTimeout(function() {
            openWhatsApp();
        }, 500);
    }
    
    function handleWhatsAppError(errorMessage) {
        $('#loading-message').hide();
        $('#error-text').text(errorMessage);
        $('#error-message').show();
        
        $('#whatsapp-btn').show().off('click').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (whatsappUrl) {
                openWhatsApp();
            } else {
                retryCount = 0;
                $('#error-message').hide();
                $('#loading-message').show();
                fetchWhatsAppMessage();
            }
        });
        
        if (typeof $.notify !== 'undefined') {
            $.notify(errorMessage, 'error');
        }
    }
    
    function openWhatsApp() {
        // Prevent multiple simultaneous calls
        if (isOpening || !whatsappUrl) {
            console.log('WhatsApp already opening or no URL available');
            return;
        }
        
        isOpening = true;
        console.log('Opening WhatsApp with URL:', whatsappUrl);
        
        // Disable the button temporarily
        $('#whatsapp-btn').prop('disabled', true).text('{{ __("Opening...") }}');
        
        // Use only ONE method - the most reliable one
        try {
            // Method 1: Direct window.location (most reliable for mobile)
            if (/Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                window.location.href = whatsappUrl;
            } else {
                // Method 2: window.open for desktop
                var whatsappWindow = window.open(whatsappUrl, '_blank', 'noopener,noreferrer');
                if (whatsappWindow) {
                    whatsappWindow.focus();
                }
            }
            
            // Update UI after successful opening
            setTimeout(function() {
                $('#success-message').show().html('<i class="fas fa-check-circle me-2"></i>{{ __("WhatsApp opened! If it didn\'t work, try the button again.") }}');
                $('#error-message').hide();
                $('#whatsapp-btn').prop('disabled', false).text('{{ __("Open WhatsApp Again") }}');
                isOpening = false;
            }, 1000);
            
        } catch (error) {
            console.error('Error opening WhatsApp:', error);
            handleWhatsAppError('{{ __("Unable to open WhatsApp. Please try again.") }}');
            $('#whatsapp-btn').prop('disabled', false).text('{{ __("Try Again") }}');
            isOpening = false;
        }
    }
    
    // Start the process
    fetchWhatsAppMessage();
    
    // Add keyboard shortcut (Enter key) to trigger WhatsApp
    $(document).on('keypress', function(e) {
        if (e.which === 13 && $('#whatsapp-btn').is(':visible') && !$('#whatsapp-btn').prop('disabled')) {
            e.preventDefault();
            $('#whatsapp-btn').click();
        }
    });
    
    // Add retry button functionality
    $(document).on('click', '#retry-btn', function(e) {
        e.preventDefault();
        e.stopPropagation();
        retryCount = 0;
        $('#error-message').hide();
        $('#loading-message').show();
        fetchWhatsAppMessage();
    });
});

</script>
@endsection