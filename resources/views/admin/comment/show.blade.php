@extends('layouts.load')
@section('content')

    <div class="content-area no-padding">
        <div class="add-product-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-description">
                        <div class="body-area">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="table-responsive show-table">
                                        <table class="table">

                                            @if (!empty($data->user))
                                                <tr>
                                                    <th>{{ __('Commenter') }}</th>
                                                    <td>{{ $data->user->name }}</td>
                                                </tr>

                                                @if ($data->user->phone != '')
                                                    <tr>
                                                        <th>{{ __('Phone') }}:</th>
                                                        <td>{{ $data->user->phone }}</td>
                                                    </tr>
                                                @endif
                                            @else
                                                <tr>---</tr>
                                            @endif

                                            <tr>
                                                <th>{{ __('Commented at') }}:</th>
                                                <td>{{ date('d-M-Y h:i:s', strtotime($data->created_at)) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h5 class="comment">
                                        {{ __('Comment') }}:
                                    </h5>
                                    <p class="comment-text">
                                        {{ $data->text }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
