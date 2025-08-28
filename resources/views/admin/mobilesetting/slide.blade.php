
												       	@foreach($slides as $data)
                                                     <option value="{{ $data->id }}"> {{ $data->name }} </option>
                                                     @endforeach