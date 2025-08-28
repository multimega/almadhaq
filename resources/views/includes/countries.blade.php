<option value="">{{ $langg->lang157 }}</option>
@if(Auth::check())
	@foreach (DB::table('countries')->get() as $data)
<!--	<option value="{{ $data->country_name }}">{{ $data->country_name }}</option>-->
	
	 @if($data->status == 1)
	    <option value="{{ $data->country_name }}">{{ $data->country_name }}</option>
	 @endif
	@endforeach
@else
	@foreach (DB::table('countries')->get() as $data)

   @if($data->status == 1)
	<option value="{{ $data->country_name }}"> {{ $data->country_name }}</option>		
	@endif
	
	@endforeach
@endif