@extends('layouts.load')

@section('content')

            <div class="content-area">

              <div class="add-product-content">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="product-description">
                      <div class="body-area">
                        @include('includes.admin.form-error') 
                     	<div class="table-responsiv">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="50%">
													<thead>
														<tr>
									                        <th>{{ __('#id') }}</th>
									                        <th>{{ __('Product') }}</th>
									                        <th>{{ __('Price') }}</th>
									                       
									                        <th>{{ __('Options') }}</th>
														</tr>
													</thead>
													<tbody>
													    @foreach($data as $d)
													    @php
													    $pro = App\Models\Product::find($d->product_id);
													    @endphp
													    <tr>
													    <td>{{$d->id}}</td>
													    <td>@if($pro){{$pro->name}} @else deleted @endif </td>
													    <td>@if($pro){{$pro->price}} @else 0  @endif </td>
													    <td>
													                                                                     <a href="javascript:;" data-href="{{route('admin-offer-product-delete',$d->id)}}" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a>

													        <!--<div class="action-list">
                                                             </div>--> </td>
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

@endsection

@section('scripts')
<script type="text/javascript">

{{-- TAGIT --}}

          $("#metatags").tagit({
          fieldName: "meta_tag[]",
          allowSpaces: true 
          });

{{-- TAGIT ENDS--}}
</script>
@endsection