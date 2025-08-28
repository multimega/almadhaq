{{-- If This product belongs to vendor then apply this --}}
@if($prod->user_id != 0)

{{-- check If This vendor status is active --}}
@if(!empty($prod->user->is_vendor))
@if($prod->user->is_vendor == 2)

<li>
    <div class="single-box">
        <div class="left-area">
            <a href="{{ route('front.product',['slug' => $prod->slug_ar ,'lang' => $sign]) }}">
                <img src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                    alt="" style="width:100%;height:auto;">
            </a>
        </div>
        <div class="right-area">
		    {{--
            <div class="stars">
                <div class="ratings">
                    <div class="empty-stars"></div>
                    <div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
                </div>
            </div>
            --}}
            <h4 class="price">{{ $prod->showPrice() }} <del>{{ $prod->showPreviousPrice() }}</del> </h4>
            <p class="text">
                @if(!$slang)
                @if($lang->id == 2)
                <a href="{{ route('front.product',['slug' => $prod->slug_ar ,'lang' => $sign]) }}">
                    {!! strlen($prod->name_ar) > 55 ? substr($prod->name_ar,0,55).'...' : $prod->name_ar !!}
                    @else
                    <a href="{{ route('front.product',['slug' => $prod->slug ,'lang' => $sign]) }}">
                        {{ strlen($prod->name) > 35 ? substr($prod->name,0,35).'...' : $prod->name }}
                        @endif
                        @else
                        @if($slang == 2)
                        <a href="{{ route('front.product',['slug' => $prod->slug_ar ,'lang' => $sign]) }}">
                            {!! strlen($prod->name_ar) > 55 ? substr($prod->name_ar,0,55).'...' : $prod->name_ar !!}
                            @else
                            <a href="{{ route('front.product',['slug' => $prod->slug ,'lang' => $sign]) }}">
                                {{ strlen($prod->name) > 35 ? substr($prod->name,0,35).'...' : $prod->name }}
                                @endif
                                @endif
                            </a>
            </p>
        </div>
    </div>
</li>


@endif
@endif

{{-- If This product belongs admin and apply this --}}

@else

<li>
    <div class="single-box">
        <div class="left-area">
            <a href="{{ route('front.product',['slug' => $prod->slug_ar ,'lang' => $sign]) }}">
                <img src="{{ $prod->photo ? filter_var($prod->photo, FILTER_VALIDATE_URL) ? $prod->photo :asset('assets/images/products/'.$prod->photo):asset('assets/images/noimage.png') }}"
                    alt="">
            </a>
        </div>
        <div class="right-area">
		    {{--
            <div class="stars">
                <div class="ratings">
                    <div class="empty-stars"></div>
                    <div class="full-stars" style="width:{{App\Models\Rating::ratings($prod->id)}}%"></div>
                </div>
            </div>
            --}}
            <h4 class="price">@if(!$slang)
                @if($lang->id == 2)
                {{ $prod->showPrice_ar() }}
                @else
                {{ $prod->showPrice() }}
                @endif
                @else
                @if($slang == 2)
                {{ $prod->showPrice_ar() }}
                @else
                {{ $prod->showPrice() }}
                @endif
                @endif <del>@if(!$slang)
                    @if($lang->id == 2)
                    {{ $prod->showPreviousPrice_ar() }}
                    @else
                    {{ $prod->showPreviousPrice() }}
                    @endif
                    @else
                    @if($slang == 2)
                    {{ $prod->showPreviousPrice_ar() }}
                    @else
                    {{ $prod->showPreviousPrice() }}
                    @endif
                    @endif</del> </h4>
            <p class="text"> @if(!$slang)
                @if($lang->id == 2)
                <a href="{{ route('front.product',['slug' => $prod->slug_ar ,'lang' => $sign]) }}">
                    {!! strlen($prod->name_ar) > 55 ? substr($prod->name_ar,0,55).'...' : $prod->name_ar !!}
                    @else
                    <a href="{{ route('front.product',['slug' => $prod->slug ,'lang' => $sign]) }}">
                        {{ strlen($prod->name) > 35 ? substr($prod->name,0,35).'...' : $prod->name }}
                        @endif
                        @else
                        @if($slang == 2)
                        <a href="{{ route('front.product',['slug' => $prod->slug_ar ,'lang' => $sign]) }}">
                            {!! strlen($prod->name_ar) > 55 ? substr($prod->name_ar,0,55).'...' : $prod->name_ar !!}
                            @else
                            <a href="{{ route('front.product',['slug' => $prod->slug ,'lang' => $sign]) }}">
                                {{ strlen($prod->name) > 35 ? substr($prod->name,0,35).'...' : $prod->name }}
                                @endif
                                @endif</a>
            </p>
        </div>
    </div>
</li>


@endif