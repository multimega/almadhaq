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
                        <div class="mr-breadcrumb">
                            <div class="row">
                                <div class="col-lg-12">
                                        <h4 class="heading">{{ __('Order Details') }} <a class="add-btn" href="javascript:history.back();"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a></h4>
                                        <ul class="links">
                                            <li>
                                                <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">{{ __('Orders') }}</a>
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
                                             Sender Details
                                            </h4>
                                        </div>
                                        <div class="table-responsive-sm">
                                            <table class="table">
                                                <tbody>
                                            
                                                <tr>
                                                    <th width="45%">Sender Name</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$m['output']['sender_address']['sender_name']}}</td>
                                                </tr>
                                               
                                                 <tr>
                                                    <th width="45%">Sender Mobile</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$m['output']['sender_address']['sender_mobile1']}}</td>
                                                </tr>
                                                
                                                 <tr>
                                                    <th width="45%">Sender Country</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$m['output']['sender_address']['sender_country']}}</td>
                                                </tr>
                                                 <tr>
                                                    <th width="45%">Sender City</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$m['output']['sender_address']['sender_city']}}</td>
                                                </tr>
                                                 <tr>
                                                    <th width="45%">Sender Area</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$m['output']['sender_address']['sender_area']}}</td>
                                                </tr>
                   
                                                </tbody>
                                            </table>
                                            </div>
                                            </div>
                                       
                                       </div>
                                <div class="col-lg-6">
                                    <div class="special-box">
                                        <div class="heading-area">
                                            <h4 class="title">
                                        
                                              Reciever Details
                                            </h4>
                                        </div>
                                        <div class="table-responsive-sm">
                                            <table class="table">
                                                <tbody>
                                               <tr>
                                                    <th width="45%">Reciever Name</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$m['output']['receiver_address']['receiver_name']}}</td>
                                                </tr>
                                                <tr>
                                                    <th width="45%">Reciever Mobile</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$m['output']['receiver_address']['receiver_mobile1']}}</td>
                                                </tr>
                                               <tr>
                                                    <th width="45%">Reciever Country</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$m['output']['receiver_address']['receiver_country']}}</td>
                                                </tr>
                                                   <tr>
                                                    <th width="45%">Reciever City</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$m['output']['receiver_address']['receiver_city']}}</td>
                                                </tr>
                                                   <tr>
                                                    <th width="45%">Receiver Area</th>
                                                    <td width="10%">:</td>
                                                    <td width="45%">{{$m['output']['receiver_address']['receiver_area']}}</td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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