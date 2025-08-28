<div style="text-align: right"> <div style="margin-bottom: 40px">
     <div> <h4 style="font-size: 20px;margin-bottom: 12px;color: #000">تفاصيل الطلب</h4>
     <p style="color: #000"><strong style="font-size: 16px;color: #000">مرحبا</strong> {{ $order->customer_name }}</p> <p style="color: #000"><strong style="font-size: 16px;color: #000">رقم الطلب: </strong>{{ $order->order_number }}</p> {{-- Track order Link --}} <p style="color:#000"><strong style="font-size:16px">رابط تتبع الطلب:</strong> <a href="{{ route('user-order', $order->id) }}">اضغط هنا</a> </p>

    </div>
</div>
<div style="margin-bottom: 40px">
    {{-- تفاصيل العميل --}}
    <div class="customer-details" style="width:50%;float: left">
        <h4 style="font-size: 20px;color: #000;margin-bottom: 12px">تفاصيل الفواتير</h4>
        <ul style="padding: 0; list-style: none">
            <li style="color: #000;margin-left: 0"><strong style="font-size: 15px;">البريد الإلكتروني:</strong> {{ $order->customer_email }}</li>
            <li style="color: #000;margin-left: 0"><strong style="font-size: 15px;">الاسم:</strong> {{ $order->customer_name }}</li>
            <li style="color: #000;margin-left: 0"><strong style="font-size: 15px;">الدولة:</strong> {{ $order->customer_country }}</li>
            <li style="color: #000;margin-left: 0"><strong style="font-size: 15px;">الهاتف:</strong> {{ $order->customer_phone }}</li>
            <li style="color: #000;margin-left: 0"><strong style="font-size: 15px;">العنوان:</strong> {{ $order->customer_address }}</li>
            <li style="color: #000;margin-left: 0"><strong style="font-size: 15px;">المدينة:</strong> {{ $order->customer_city }}</li>
        </ul>
    </div>
    <div style="width:50%;float: left">
        <h4 style="font-size: 20px;margin-bottom: 12px;color: #000">معلومات الدفع</h4>
        <p style="color: #000"><strong style="font-size: 16px;color: #000">طريقة الدفع: </strong> {{ $order->method }}</p>
        <p style="color: #000"><strong style="font-size: 16px;color: #000">سعر الشحن ({{ $order->currency_sign }}):</strong> {{ $order->shipping_price }}</p>
        <p style="color: #000"><strong style="font-size: 16px;color: #000">ضريبة القيمة المضافة: 15% </p>
       <p style="color: #000">
    <strong style="font-size: 16px;color: #000">
         {{ round(($order->pay_amount - $order->shipping_price) - (($order->pay_amount - $order->shipping_price) / 1.15),2) }} ضريبة القيمة المضافة:- 
    </strong>
</p>
<p style="color: #000">
    <strong style="font-size: 16px;color: #000">
         ({{ $order->currency_sign }}) الاجمالى بدون قيمة الضريبة المضافة :
        {{ round(($order->pay_amount - $order->shipping_price) -  ($order->pay_amount - $order->shipping_price) - (($order->pay_amount - $order->shipping_price) / 1.15),2) }}
    </strong>
</p>

<p style="color: #000"><strong style="font-size: 16px;color: #000">الإجمالي مع الشحن والضريبة المضافة :({{ $order->currency_sign }}):</strong> {{ round($order->pay_amount * $order->currency_value, 2) }}</p> </div> </div> {{-- صور المنتجات في الطلب --}} <div> <table style="border: 1px solid #dee2e6;width: 100%;border-collapse: collapse;"> <thead> <tr style="font-size:15px;font-weight:600;color:#000;text-align:left"> <th style="padding: 16px;border:1px solid #dee2e6;">صورة المنتج</th> <th style="padding: 16px;border:1px solid #dee2e6;">اسم المنتج</th> <th style="padding: 16px;border:1px solid #dee2e6;">تفاصيل المنتج</th> </tr> </thead> <tbody> @foreach ($products as $product) <tr> <td style="border: 1px solid #dee2e6;padding: 16px"> <img src="{{ asset('assets/images/products/' . $product['item']['photo']) }}" alt="صورة المنتج" style="height: 140px; object-fit: contain"> </td> <td style="border: 1px solid #dee2e6;padding: 16px">{{ $product['item']['name'] }}</td> <td style="border: 1px solid #dee2e6;padding: 16px"> <p><strong>السعر:</strong> {{ $product['price'] }}</p> <p><strong>الحجم:</strong> {{ $product['size'] }}</p> <p style="display: flex"><strong>اللون: </strong> <span style="margin-left: 6px;display: inline-block;width:40px; height: 20px; background-color: #{{ $product['color'] }};"></span></p> <p><strong>الكمية:</strong> {{ $product['qty'] }}</p> </td> </tr> @endforeach </tbody> </table> </div> </div>