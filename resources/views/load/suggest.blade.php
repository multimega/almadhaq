
@php 

$slang = Session::get('language');
$lang  = DB::table('languages')->where('is_default','=',1)->first();


@endphp
@foreach($prods as $prod)

 @if($prod->status == 1) 
  	<div class="docname">
		<a href="{{ route('front.product',['slug' =>$prod->slug , 'lang' => $sign]) }}">
			<img src="{{filter_var($prod->thumbnail, FILTER_VALIDATE_URL) ? $prod->thumbnail : asset('assets/images/thumbnails/'.$prod->thumbnail) }}" alt="">
			<div class="search-content">
				<p>	@if(!$slang)
              @if($lang->id == 2)
             {!! strlen($prod->name_ar) > 100 ? str_replace($slug,'<b>'.$slug.'</b>',substr($prod->name_ar,0,100)).'...' : str_replace($slug,'<b>'.$slug.'</b>',$prod->name_ar)  !!}
              @else 
             {!! strlen($prod->name) > 66 ? str_replace($slug,'<b>'.$slug.'</b>',substr($prod->name,0,66)).'...' : str_replace($slug,'<b>'.$slug.'</b>',$prod->name)  !!}
              @endif 
          @else  
              @if($slang == 2) 
              {!! strlen($prod->name_ar) > 100 ? str_replace($slug,'<b>'.$slug.'</b>',substr($prod->name_ar,0,100)).'...' : str_replace($slug,'<b>'.$slug.'</b>',$prod->name_ar)  !!}
              @else
              {!! strlen($prod->name) > 66 ? str_replace($slug,'<b>'.$slug.'</b>',substr($prod->name,0,66)).'...' : str_replace($slug,'<b>'.$slug.'</b>',$prod->name)  !!}
              @endif
          @endif </p>
				<span style="font-size: 14px; font-weight:600; display:block;">{{ $prod->showPrice() }}</span>
			</div>
		</a>
	</div> 
@endif
@endforeach