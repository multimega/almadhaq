   @if(!empty(Auth::guard('web')->user()->address)  ) <option value="{{Auth::guard('web')->user()->address }}" > {{Auth::guard('web')->user()->address }} </option> @endif
												      
												       	@foreach($addresses as $data)
                                                     <option value="{{ $data->address }}"> {{ $data->address }} </option>
                                                     @endforeach