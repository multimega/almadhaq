@extends('layouts.front_34')

@section('content')
    <div class="acc-settings">
        <div class="row m-0">
            @include('includes.user-dashboard-34-sidebar')
            <div class="col-lg-10 col-md-9 hidden-classes mb-3">
                <div>
                    <div class="settings-container">
                        <h3>{{ $langg->lang262 }}</h3>
                        <div class="no-orders text-center">
                            <div class="edit-info-area-form">
                                <div class="gocover"
                                    style="background: url({{ asset('assets/images/' . $gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);">
                                </div>
                                <form id="userform" action="{{ route('user-profile-update') }}" method="POST"
                                    enctype="multipart/form-data">

                                    {{ csrf_field() }}

                                    @include('includes.admin.form-both')
                                    <div class="upload-img mb-4">
                                        @if ($user->is_provider == 1)
                                            <div class="img"><img
                                                    src="{{ $user->photo ? asset($user->photo) : asset('assets/images/' . $gs->user_image) }}">
                                            </div>
                                        @else
                                            <div class="img"><img
                                                    src="{{ $user->photo ? asset('assets/images/users/' . $user->photo) : asset('assets/images/' . $gs->user_image) }}">
                                            </div>
                                        @endif
                                        @if ($user->is_provider != 1)
                                            <div class="file-upload-area">
                                                <div class="upload-file">
                                                    <input type="file" name="photo" class="upload">
                                                    <span>{{ $langg->lang263 }}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input name="name" type="text" class="input-field form-control"
                                                placeholder="{{ $langg->lang264 }}" required=""
                                                value="{{ $user->name }}">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input name="phone" type="text" class="input-field form-control"
                                                placeholder="{{ $langg->lang266 }}" required=""
                                                value="{{ $user->phone }}">
                                        </div>
                                        <div class="col-lg-6">
                                            <input name="fax" type="text" class="input-field form-control"
                                                placeholder="{{ $langg->lang267 }}" value="{{ $user->fax }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input name="city" type="text" class="input-field form-control"
                                                placeholder="{{ $langg->lang268 }}" value="{{ $user->city }}">
                                        </div>

                                        <div class="col-lg-6">
                                            <select class="input-field form-control" name="country">
                                                <option value="">{{ $langg->lang157 }}</option>
                                                @foreach (DB::table('countries')->get() as $data)
                                                    <option value="{{ $data->country_name }}"
                                                        {{ $user->country == $data->country_name ? 'selected' : '' }}>
                                                        {{ $data->country_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input name="zip" type="text" class="input-field form-control"
                                                placeholder="{{ $langg->lang269 }}" value="{{ $user->zip }}">
                                        </div>

                                        <div class="col-lg-6">
                                            <textarea class="input-field form-control" name="address" required="" placeholder="{{ $langg->lang270 }}">{{ $user->address }}</textarea>
                                        </div>

                                    </div>

                                    <div class="form-links">
                                        <button class="submit-btn form-control btn btn-success"
                                            type="submit">{{ $langg->lang271 }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
