@extends('layouts.front_34')

@section('content')

<div class="acc-settings">
    <div class="row m-0">
        @include('includes.user-dashboard-34-sidebar')
        <div class="col-lg-10 col-md-9 hidden-classes mb-3">
            <div>
                <div class="settings-container">
                    <h3>{{ $langg->lang807 }}</h3>
                    <div class="no-orders text-center">
                        <div class="mr-table allproduct message-area  mt-4">
								@include('includes.form-success')
								<div class="table-responsiv">
								<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>{{ $langg->lang381 }}</th>
											<th>{{ $langg->lang382 }}</th>
											<th>{{ $langg->lang383 }}</th>
										</tr>
									</thead>
									<tbody>
                                        @foreach($notifications as $conv)
                                        
                                            <tr class="conv">
                                                <input type="hidden" value="{{$conv->id}}">
                                                <td>{{$conv->text}}</td>
                                                <td>{{$conv->created_at->diffForHumans()}}</td>
                                                <td>
                                                 @if($conv->type == "link")  <a href="{{route('readnotif',$conv->id)}}" class="link view"><i class="fa fa-eye"></i></a> @endif
                                                </td>
                                            </tr>
                                        @endforeach
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

@endsection


@section('scripts')

<script type="text/javascript">
    
          $(document).on("submit", "#emailreply1" , function(){
          var token = $(this).find('input[name=_token]').val();
          var subject = $(this).find('input[name=subject]').val();
          var message =  $(this).find('textarea[name=message]').val();
          var $type  = $(this).find('input[name=type]').val();
          $('#subj1').prop('disabled', true);
          $('#msg1').prop('disabled', true);
          $('#emlsub1').prop('disabled', true);
     $.ajax({
            type: 'post',
            url: "{{URL::to('/user/admin/user/send/message')}}",
            data: {
                '_token': token,
                'subject'   : subject,
                'message'  : message,
                'type'   : $type
                  },
            success: function( data) {
          $('#subj1').prop('disabled', false);
          $('#msg1').prop('disabled', false);
          $('#subj1').val('');
          $('#msg1').val('');
        $('#emlsub1').prop('disabled', false);
        if(data == 0)
          toastr.error("{{ $langg->something_wrong }}");
        else
          toastr.success("{{ $langg->message_sent }}");
        $('.close').click();
            }

        });          
          return false;
        });

</script>


<script type="text/javascript">

      $('#confirm-delete').on('show.bs.modal', function(e) {
          $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });

</script>

@endsection