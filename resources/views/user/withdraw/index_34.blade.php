@extends('layouts.front_34')

@section('content')

<div class="acc-settings">
    <div class="row m-0">
        @include('includes.user-dashboard-34-sidebar')
        <div class="col-lg-10 col-md-9 hidden-classes mb-3">
            <div>
                <div class="settings-container">
                    <div class="settings-header d-flex justify-content-between align-items-center">
                        <h3>{{ $langg->lang329 }}</h3>
    					<a class="btn btn-success" href="{{route('user-wwt-create-34')}}"> <i class="fas fa-plus"></i> {{ $langg->lang330 }}</a>
					</div>
                    <div class="no-orders text-center">
						<div class="mr-table allproduct mt-4">
							<div class="table-responsiv">
								<table id="example" class="table table-hover dt-responsive" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>{{ $langg->lang331 }}</th>
											<th>{{ $langg->lang332 }}</th>
											<th>{{ $langg->lang333 }}</th>
											<th>{{ $langg->lang334 }}</th>
											<th>{{ $langg->lang335 }}</th>
										</tr>
									</thead>
									<tbody>
                                    @foreach($withdraws as $withdraw)
                                        <tr>
                                            <td>{{date('d-M-Y',strtotime($withdraw->created_at))}}</td>
                                            <td>{{$withdraw->method}}</td>
                                            @if($withdraw->method != "Bank")
                                                <td>{{$withdraw->acc_email}}</td>
                                            @else
                                                <td>{{$withdraw->iban}}</td>
                                            @endif
                                            <td>{{$sign->sign}}{{ round($withdraw->amount * $sign->value , 2) }}</td>
                                            <td>{{ucfirst($withdraw->status)}}</td>
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