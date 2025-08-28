@php
$slang = Session::get('language');
@endphp

@php
    $translations = array();

    foreach ($datas as $key => $value) {
        $translations[ucwords($key)] = $value;
    }
@endphp
                        @if(isset($order))
                    <div class="tracking-steps-area">

                            <ul class="tracking-steps">
                                @foreach($order->tracks as $index => $track)
    @php
        $translatedTitle = $slang == 2 ? $translations[ucwords($track->title)] : ucwords($track->title);
        $isActive = array_key_exists($track->title, $datas) ? 'active' : '';
    @endphp

    <li class="{{ $isActive }}">
        <div class="icon">{{ $index + 1 }}</div>
        <div class="content">
            <h4 class="title">{{ $translatedTitle }}</h4>
            <p class="date">{{ date('d m Y',strtotime($track->created_at)) }}</p>
        </div>
    </li>
@endforeach

                                </ul>
                    </div>


                        @else 
                        <h3 class="text-center">{{ $langg->lang775 }}</h3>
                        @endif          