@extends('layouts.front_34')

@section('content')

<div class="acc-settings">
    <div class="row m-0">
        @include('includes.user-dashboard-34-sidebar')
        <div class="col-lg-10 col-md-9 hidden-classes mb-3">
            <div>
                <div class="settings-container">
                    <div class="settings-header d-flex justify-content-between align-items-center">
                        @if( $conv->order_number != null )
                        <h3>
                            {{ $langg->lang396 }} {{ $conv->order_number }} 
                        </h3>
                        @endif
                        <h3>
                            {{ $langg->lang397 }} {{$conv->subject}}
                        </h3>
    					<a class="btn btn-success" href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i> {{ $langg->lang398 }}</a>
					</div>
                    <div class="no-orders text-center">
                        
                    <div class="support-ticket-wrapper ">
                        <div class="panel panel-primary">
                            <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>                  
                                <div class="panel-body" id="messages">
                                    @foreach($conv->messages as $message)
                                        @if($message->user_id != 0)
                                        <div class="single-reply-area user">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="reply-area">
                                                        <div class="left">
                                                            @if($message->conversation->user->is_provider == 1)
                                                            <img class="img-circle" src="{{$message->conversation->user->photo != null ? $message->conversation->user->photo : asset('assets/images/noimage.png')}}" alt="">
                                                            @else 
                                                            <img class="img-circle" src="{{$message->conversation->user->photo != null ? asset('assets/images/users/'.$message->conversation->user->photo) : asset('assets/images/noimage.png')}}" alt="">
                                                            @endif
                                                            <p class="ticket-date">{{$message->conversation->user->name}}</p>
                                                        </div>
                                                        <div class="right">
                                                            <p>{{$message->message}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="single-reply-area user">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="reply-area">
                                                        <div class="right">
                                                            <p>{{ $message->message }}</p>
                                                        </div>
                                                        <div class="left">
                                                            <img class="img-circle" src="{{ asset('assets/images/admin.jpg')}}" alt="">
                                                            <p class="ticket-date">{{ $langg->lang399 }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="panel-footer">
                                    <form id="messageform" data-href="{{ route('user-message-load',$conv->id) }}" action="{{route('user-message-store')}}" method="POST">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <input type="hidden" name="conversation_id" value="{{$conv->id}}">
                                            <input type="hidden" name="user_id" value="{{$conv->user->id}}">
                                            <textarea class="form-control" name="message" id="wrong-invoice" rows="5" style="resize: vertical;" required="" placeholder="{{ $langg->lang400 }}"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button class="mybtn1 btn btn-success">{{ $langg->lang401 }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
						</div>
                   </div>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection
