@extends('layouts.front_34')

@section('content')
    <div class="acc-settings">
        <div class="row m-0">
            @include('includes.user-dashboard-34-sidebar')
            <div class="col-lg-10 col-md-9 hidden-classes mb-3">
                <div>
                    <div class="settings-container">
                        <h3>{{ $langg->lang208 }}</h3>
                        <div class="no-orders text-center">
                            <h4 class="text-left mb-3">{{ $user->name }}</h5>
                                <ul class="list-unstyled text-left">

                                    @if ($user->phone != null)
                                        <li class='active m-0'>
                                            <span class="user-title">{{ $langg->lang210 }}:</span> {{ $user->phone }}
                                        </li>
                                    @endif
                                    @if ($user->fax != null)
                                        <li class='active m-0'>
                                            <span class="user-title">{{ $langg->lang211 }}:</span> {{ $user->fax }}
                                        </li>
                                    @endif
                                    @if ($user->city != null)
                                        <li class='active m-0'>
                                            <span class="user-title">{{ $langg->lang212 }}:</span> {{ $user->city }}
                                        </li>
                                    @endif
                                    @if ($user->zip != null)
                                        <li class='active m-0'>
                                            <span class="user-title">{{ $langg->lang213 }}:</span> {{ $user->zip }}
                                        </li>
                                    @endif
                                    @if ($user->address != null)
                                        <li class='active m-0'>
                                            <span class="user-title">{{ $langg->lang214 }}:</span> {{ $user->address }}
                                        </li>
                                    @endif
                                    <li class='active m-0'>
                                        <span class="user-title">{{ $langg->lang215 }}:</span>
                                        {{ App\Models\Product::vendorConvertPrice($user->affilate_income) }}
                                    </li>
                                </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
