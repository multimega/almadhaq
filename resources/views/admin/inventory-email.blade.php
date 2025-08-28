<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Preparation</title>
    <link rel="stylesheet" href="{{asset('assets/demo_19/assets/css/bootstrap.min.css')}}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-4">Dear warehouse team,</h2>
                <p class="lead">Please prepare the following order for shipment:</p>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p class="font-weight-bold">Invoice number:</p>
                        <p>{{ $order->order_number }}</p>
                       
                    </div>
                    <div class="col-md-6">
                        <p class="font-weight-bold">Products:</p>
                        <ul class="list-group">
                         
                            @foreach ($cart->items as $product)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>{{ $product['item']['name'] }}</span>
                                    <span class="badge badge-primary badge-pill">{{ $product['qty'] }}</span>
                                    <div>
                                        @if ($product['size'])
                                            <p><strong>{{ __('Size') }}:</strong> {{ $product['size'] }}</p>
                                        @endif
                                        @if ($product['color'])
                                            <p>
                                                <strong>{{ __('Color') }}:</strong>
                                                <span style="width: 40px; height: 20px; display: inline-block; background-color: #{{ $product['color'] }}"></span>
                                            </p>
                                        @endif
                                        <p><strong>{{ __('Quantity') }}:</strong> {{ $product['qty'] }} {{ $product['item']['measure'] }}</p>
                                    </div>
                                </li>
                            @endforeach
                        
                        </ul>
                    </div>
                </div>
                <hr>
                <p class="lead">Thank you!</p>
            </div>
        </div>
    </div>
</body>
</html>