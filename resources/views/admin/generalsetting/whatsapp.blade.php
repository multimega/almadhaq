@extends('layouts.admin')

@section('styles')
<style type="text/css">
    .placeholder-info {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1rem;
        margin-top: 1rem;
    }

    .placeholder-item {
        margin-bottom: 0.5rem;
    }

    .placeholder-code {
        background-color: #e9ecef;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-family: monospace;
    }
</style>
@endsection

@section('content')
<div class="content-area">
    <div class="mr-breadcrumb">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="heading">{{ __('Whatsapp') }}</h4>
                <ul class="links">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/main-settings') }}">Main Settings</a>
                    </li>
                    <li>
                        <a href="{{ url('admin/general-settings') }}">General Settings</a>
                    </li>
                    <li>
                        <a href="{{ route('admin-gs-whatsapp') }}">{{ __('Whatsapp Setting') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>WhatsApp Message Settings</h4>
                    </div>
                    <div class="card-body">
                        <form id="whatsappSettingsForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="whatsapp_country_code" class="form-label">Country Code</label>
                                        <input type="text" class="form-control" id="whatsapp_country_code"
                                            name="whatsapp_country_code" value="{{ $whatsappCountryCode }}"
                                            placeholder="e.g., +20, +971, +44">
                                        <div class="form-text">Default country code to prepend to phone numbers</div>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="whatsapp_number" class="form-label">Whatsapp Number</label>
                                        <input type="text" class="form-control" id="whatsapp_number"
                                            name="whatsapp_number" value="{{ $whatsappNumber }}"
                                            placeholder="501234567">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="mb-3">
                                <label for="whatsapp_message_template" class="form-label">Message Template</label>
                                  <textarea class="form-control"
                                          id="whatsapp_message_template"
                                          name="whatsapp_message_template"
                                          rows="15"
                                          dir="auto"
                                          style="text-align: left; white-space: pre-wrap;"
                                          placeholder="Enter your custom WhatsApp message template...">{!! $messageTemplate !!}</textarea>

                            </div>

                            <div class="placeholder-info">
                                <h5>Available Placeholders:</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="placeholder-item">
                                            <span class="placeholder-code">{ORDER_NUMBER}</span> - Order ID/Number
                                        </div>
                                        <div class="placeholder-item">
                                            <span class="placeholder-code">{ORDER_DATE}</span> - Order Creation Date
                                        </div>
                                        <div class="placeholder-item">
                                            <span class="placeholder-code">{ORDER_TOTAL}</span> - Total Order Amount
                                        </div>
                                        <div class="placeholder-item">
                                            <span class="placeholder-code">{PAYMENT_METHOD}</span> - Payment Method
                                        </div>
                                        <div class="placeholder-item">
                                            <span class="placeholder-code">{ORDER_STATUS}</span> - Current Order Status
                                        </div>
                                        <div class="placeholder-item">
                                            <span class="placeholder-code">{CURRENCY_SIGN}</span> - Currency Symbol
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="placeholder-item">
                                            <span class="placeholder-code">{CUSTOMER_NAME}</span> - Customer Name
                                        </div>
                                        <div class="placeholder-item">
                                            <span class="placeholder-code">{CUSTOMER_EMAIL}</span> - Customer Email
                                        </div>
                                        <div class="placeholder-item">
                                            <span class="placeholder-code">{CUSTOMER_PHONE}</span> - Customer Phone
                                        </div>
                                        <div class="placeholder-item">
                                            <span class="placeholder-code">{PRODUCTS_LIST}</span> - List of All Products
                                        </div>
                                        <div class="placeholder-item">
                                            <span class="placeholder-code">{SHIPPING_DETAILS}</span> - Shipping
                                            Information
                                        </div>
                                        <div class="placeholder-item">
                                            <span class="placeholder-code">{TRACKING_INFO}</span> - Tracking Number (if
                                            available)
                                        </div>
                                        
                                          <div class="placeholder-item">
                                            <span class="placeholder-code">{CUSTOMER_DETAILS}</span> - Customer Information (if
                                            available)
                                        </div>
                                        
                                          <div class="placeholder-item">
                                            <span class="placeholder-code">{DELIVERY_SCHEDULE}</span> - Delivery SCHEDULE (if
                                            available)
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <strong>Note:</strong> You can customize the message structure and remove any
                                    placeholders you don't need.
                                    Empty placeholders will be automatically cleaned up.
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Save Settings</button>
                                <button type="button" class="btn btn-secondary" id="previewBtn">Preview
                                    Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Message Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <strong>Note:</strong> This is a preview with sample data. Actual messages will use real order
                        information.
                    </div>
                    <pre id="messagePreview"
                        style="white-space: pre-wrap; background-color: #f8f9fa; padding: 1rem; border-radius: 0.375rem;"></pre>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection

@section('scripts')

<!--<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>-->
<!--<script type="text/javascript">-->
<!--	$(document).ready(function() {-->
<!--       $('.ckeditor').ckeditor();-->
        
<!--    });-->
    
    
<!--</script>-->


<script>
     document.getElementById('whatsappSettingsForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        
        // Disable button and show loading
        submitBtn.disabled = true;
        submitBtn.textContent = 'Saving...';
            
        // for (instance in CKEDITOR.instances) {
        //     CKEDITOR.instances[instance].updateElement();
        // }

        const formData = new FormData(this);
        
        // Convert FormData to JSON
        const jsonData = {};
        formData.forEach((value, key) => {
            jsonData[key] = value;
        });
        
        fetch('{{ route("admin.whatsapp.settings.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(jsonData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                toastr.success(data.message);

            } else {
                if (data.errors) {
                    let errorMessage = 'Validation errors:\n';
                    for (const [field, errors] of Object.entries(data.errors)) {
                        errorMessage += `${field}: ${errors.join(', ')}\n`;
                    }
                        toastr.error(errorMessage);
                } else {
                    toastr.error( data.message || 'An error occurred');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('danger', 'An error occurred while saving settings');
        })
        .finally(() => {
            // Re-enable button
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        });
    });
    
        document.getElementById('previewBtn').addEventListener('click', function() {
            const template = document.getElementById('whatsapp_message_template').value;

            // Sample data for preview
            const sampleData = {
                '{ORDER_NUMBER}': 'ORD-2024-001',
                '{ORDER_DATE}': '12-Jun-2025 14:30:00',
                '{ORDER_TOTAL}': '$129.99',
                '{PAYMENT_METHOD}': 'Credit Card',
                '{ORDER_STATUS}': 'Processing',
                '{CURRENCY_SIGN}': '$',
                '{CUSTOMER_NAME}': 'John Doe',
                '{CUSTOMER_EMAIL}': 'john@example.com',
                '{CUSTOMER_PHONE}': '+1234567890',

                '{PRODUCTS_LIST}': `• Premium T-Shirt
                Qty: 2 | Price: $29.99
                Size: L
                Color: #000000

                • Jeans
                Qty: 1 | Price: $69.99
                Size: 32
                Color: #0000FF`,

                '{SHIPPING_DETAILS}': `Name: John Doe
                Email: john@example.com
                Phone: +1234567890
                Address: 123 Main Street
                City: New York
                Country: United States
                Postal Code: 10001`,
                '{TRACKING_INFO}': 'Fedex Serial: 1234567890123456'
            };

            let preview = template;
            for (const [placeholder, value] of Object.entries(sampleData)) {
                preview = preview.replace(new RegExp(placeholder, 'g'), value);
            }

            // Clean up empty sections
            preview = preview.replace(/\n\s*\n/g, '\n\n').trim();

            document.getElementById('messagePreview').textContent = preview;

            const modal = new bootstrap.Modal(document.getElementById('previewModal'));
            modal.show();
        });
        
    document.getElementById('whatsapp_message_template').addEventListener('input', function () {
        const firstChar = this.value.trim()[0];
        if (firstChar && /[\u0600-\u06FF]/.test(firstChar)) {
            this.dir = 'rtl';
            this.style.textAlign = 'right';
        } else {
            this.dir = 'ltr';
            this.style.textAlign = 'left';
        }
    });

</script>



@endsection