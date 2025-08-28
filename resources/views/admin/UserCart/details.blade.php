@extends('layouts.admin')
@section('styles')

<style type="text/css">
    .order-table-wrap table#example2 {
    margin: 10px 20px;
}

</style>

@endsection


@section('content')

            
    <div class="content-area">
                        <div class="home-head mb-4 mb-md-5">
                            <h3>{{ __('Order Details') }} <a class="add-btn" href="javascript:history.back();"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h3>
                            <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:;">{{ __('Customer Cart') }}</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:;">{{ __('Customer Cart Details') }}</a></li>
                                </ol>
                            </nav>
                        </div>

                        <div class="order-table-wrap">
                            @include('includes.admin.form-both')
                          



                            <div class="row">
                                    <div class="col-lg-12 order-details-table">
                                        <div class="mr-table">
                                            <h4 class="title">{{ __('Customer Cart Products') }}</h4>
                                            <div class="table-responsiv">
                                                    <table id="example2" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                <tr>
                                    <th width="10%">{{ __('Product ID#') }}</th>
                                    <th>{{ __('Product Name') }}</th>
                                    <th>{{ __('Product Category') }}</th>
                                   
                                </tr>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                            @foreach($cart->items as $key => $product)
                                          
                                           <tr>
                                        
                                            <td><input type="hidden" value="{{$key}}">{{ $product['item']['id'] }}</td>

                                           
                                         


                                            <td>
                                                <input type="hidden" value="{{ $product['license'] }}">

                                                @if($product['item']['user_id'] != 0)
                                                @php
                                                $user = App\Models\User::find($product['item']['user_id']);
                                                @endphp
                                                @if(isset($user))
                                              <a target="_blank" href="{{ route('front.product', [ 'slug' => $product['item']['slug'] , 'lang' => 'en']) }}">{{strlen($product['item']['name']) > 30 ? substr($product['item']['name'],0,30).'...' : $product['item']['name']}}</a>
                                                @else
                                                <a target="_blank" href="{{ route('front.product',  [ 'slug' => $product['item']['slug'] , 'lang' => 'en']) }}">
                                                    {{strlen($product['item']['name']) > 30 ? substr($product['item']['name'],0,30).'...' : $product['item']['name']}}
                                                </a>
                                                @endif
                                                @else 

                                                <a target="_blank" href="{{ route('front.product',  [ 'slug' => $product['item']['slug'] , 'lang' => 'en']) }}">
                                                    {{strlen($product['item']['name']) > 30 ? substr($product['item']['name'],0,30).'...' : $product['item']['name']}}
                                                </a>
                                            
                                                @endif


                                                 @if($product['license'] != '')
                           
                                                    <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete" class="btn btn-info product-btn" id="license" style="padding: 5px 12px;"><i class="fa fa-eye"></i> {{ __('View License') }}</a>
                                                   
                                                 @endif

                                               </td>
                                               
                                            <td>
                                                
                                                 @php
                                                   $product_dta = App\Models\Product::find($product['item']['id']);
                                                @endphp
                                                
                                                   {{$product_dta->category->name}}
                                                
                                            </td>
                                            

                                    </tr>
                                @endforeach
                                                        </tbody>
                                                    </table>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                                
                         @if(!empty($deleted_products))       
                           <div class="row">
                                    <div class="col-lg-12 order-details-table">
                                        <div class="mr-table">
                                            <h4 class="title">{{ __('Customer Cart Deleted Products') }}</h4>
                                            <div class="table-responsiv">
                                                    <table id="example2" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                <tr>
                                    <th width="10%">{{ __('Product ID#') }}</th>
                                    <th>{{ __('Product Name') }}</th>
                                    <th>{{ __('Product Category') }}</th>
                                   
                                </tr>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                            @foreach($deleted_products as $key => $dproduct)
                                          
                                           <tr>
                                        
                                            <td><input type="hidden" value="{{$key}}">{{ $dproduct['id'] }}</td>

                                           
                                         


                                            <td>
                                                <input type="hidden" value="{{ $dproduct['license'] }}">

                                                @if($dproduct['user_id'] != 0)
                                                @php
                                                $user = App\Models\User::find($dproduct['user_id']);
                                                @endphp
                                                @if(isset($user))
                                              <a target="_blank" href="{{ route('front.product', [ 'slug' =>$dproduct['slug'] , 'lang' => 'en']) }}">{{strlen($dproduct['name']) > 30 ? substr($dproduct['name'],0,30).'...' : $dproduct['name']}}</a>
                                                @else
                                                <a target="_blank" href="{{ route('front.product',  [ 'slug' => $dproduct['slug'] , 'lang' => 'en']) }}">
                                                    {{strlen($dproduct['name']) > 30 ? substr($dproduct['name'],0,30).'...' : $dproduct['name']}}
                                                </a>
                                                @endif
                                                @else 

                                                <a target="_blank" href="{{ route('front.product',  [ 'slug' => $dproduct['slug'] , 'lang' => 'en']) }}">
                                                    {{strlen($dproduct['name']) > 30 ? substr($dproduct['name'],0,30).'...' : $dproduct['name']}}
                                                </a>
                                            
                                                @endif


                                                 @if($product['license'] != '')
                           
                                                    <a href="javascript:;" data-toggle="modal" data-target="#confirm-delete" class="btn btn-info product-btn" id="license" style="padding: 5px 12px;"><i class="fa fa-eye"></i> {{ __('View License') }}</a>
                                                   
                                                 @endif

                                               </td>
                                               
                                            <td>
                                                
                                                 @php
                                                   $product_dta = App\Models\Product::find($dproduct['id']);
                                                @endphp
                                                
                                                   {{$product_dta->category->name}}
                                                
                                            </td>
                                            

                                    </tr>
                                @endforeach
                                                        </tbody>
                                                    </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-center mt-2">
                                        <a class="btn sendEmail send" href="javascript:;" class="send" data-email="{{ $order->customer_email }}" data-toggle="modal" data-target="#vendorform">
                                                <i class="fa fa-send"></i> {{ __('Send Email') }}
                                        </a>
                                    </div>
                                </div>
                        @endif
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
                    <p class="text-center">{{ __('The Licenes Key is') }} :  <span id="key"></span> <a href="javascript:;" id="license-edit">{{ __('Edit License') }}</a><a href="javascript:;" id="license-cancel" class="showbox">{{ __('Cancel') }}</a></p>
                    <form method="POST" action="{{route('admin-order-license',$order->id)}}" id="edit-license" style="display: none;">
                        {{csrf_field()}}
                        <input type="hidden" name="license_key" id="license-key" value="">
                        <div class="form-group text-center">
                    <input type="text" name="license" placeholder="{{ __('Enter New License Key') }}" style="width: 40%; border: none;" required=""><input type="submit" name="submit" class="btn btn-primary" style="border-radius: 0; padding: 2px; margin-bottom: 2px;">
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
                                    {{csrf_field()}}
                                    <ul>
                                        <li>
                                            <input type="email" class="input-field eml-val" id="eml" name="to" placeholder="{{ __('Email') }} *" value="" required="">
                                        </li>
                                        <li>
                                            <input type="text" class="input-field" id="subj" name="subject" placeholder="{{ __('Subject') }} *" required="">
                                        </li>
                                        <li>
                                            <textarea class="input-field textarea" name="message" id="msg" placeholder="{{ __('Your Message') }} *" required=""></textarea>
                                        </li>
                                    </ul>
                                    <button class="submit-btn" id="emlsub" type="submit">{{ __('Send Email') }}</button>
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
            <img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
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
$('#example2').dataTable( {
  "ordering": false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false,
      'responsive'  : true
} );
</script>

    <script type="text/javascript">
        $(document).on('click','#license' , function(e){
            var id = $(this).parent().find('input[type=hidden]').val();
            var key = $(this).parent().parent().find('input[type=hidden]').val();
            $('#key').html(id);  
            $('#license-key').val(key);    
    });
        $(document).on('click','#license-edit' , function(e){
            $(this).hide();
            $('#edit-license').show();
            $('#license-cancel').show();
        });
        $(document).on('click','#license-cancel' , function(e){
            $(this).hide();
            $('#edit-license').hide();
            $('#license-edit').show();
        });

        $(document).on('submit','#edit-license' , function(e){
            e.preventDefault();
          $('button#license-btn').prop('disabled',true);
              $.ajax({
               method:"POST",
               url:$(this).prop('action'),
               data:new FormData(this),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
               success:function(data)
               {
                  if ((data.errors)) {
                    for(var error in data.errors)
                    {
                        $.notify('<li>'+ data.errors[error] +'</li>','error');
                    }
                  }
                  else
                  {
                    $.notify(data,'success');
                    $('button#license-btn').prop('disabled',false);
                    $('#confirm-delete').modal('toggle');

                   }
               }
                });
        });
    </script>

@endsection