@extends('layouts.front_34')

@section('content')

<div class="acc-settings">
    <div class="row m-0">
        @include('includes.user-dashboard-34-sidebar')
        <div class="col-lg-10 col-md-9 hidden-classes mb-3">
            <div>
                <div class="settings-container">
                    <div class="settings-header d-flex justify-content-between align-items-center">
                        <h3>
                            {{ $langg->lang372 }}
                            @if($user->id == $conv->sent->id)
                            {{$conv->recieved->name}}    
                            @else
                            {{$conv->sent->name}}
                            @endif
                        </h3>
    					<a class="btn btn-success" href="{{ route('user-messages-34') }}"><i class="fas fa-arrow-left"></i> {{ $langg->lang373 }}</a>
					</div>
                    <div class="no-orders text-center">
                        
                    <div class="support-ticket-wrapper ">
                        <div class="panel panel-primary">
                            <div class="gocover" style="background: url({{ asset('assets/images/'.$gs->loader) }}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>                  
                                <div class="panel-body" id="messages">
                                    @foreach($conv->messages as $message)
                                        @if($message->sent_user != null)
                                        <div class="single-reply-area admin">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="reply-area">
                                                        <div class="left">
                                                            @if($message->conversation->sent->is_provider == 1 )
                                                            <img class="img-circle" src="{{ $message->conversation->sent->photo != null ? $message->conversation->sent->photo : asset('assets/images/noimage.png') }}" alt="">
                                                            @else 
                                                            <img class="img-circle" src="{{ $message->conversation->sent->photo != null ? asset('assets/images/users/'.$message->conversation->sent->photo) : asset('assets/images/noimage.png') }}" alt="">
                                                            @endif
                                                            <p class="ticket-date">{{ $message->conversation->sent->name }}</p>
                                                        </div>
                                                        <div class="right">
                                                            <p>{{ $message->message }}</p>
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
                                                        <div class="left">
                                                            <p>{{ $message->message }}</p>
                                                        </div>
                                                        <div class="right">
                                                            @if($message->conversation->recieved->is_provider == 1 )
                                                            <img class="img-circle" src="{{ $message->conversation->recieved->photo != null ? $message->conversation->recieved->photo : asset('assets/images/noimage.png') }}" alt="">
                                                            @else 
                                                            <img class="img-circle" src="{{ $message->conversation->recieved->photo != null ? asset('assets/images/users/'.$message->conversation->recieved->photo) : asset('assets/images/noimage.png') }}" alt="">
                                                            @endif
                                                            <p class="ticket-date">{{$message->conversation->recieved->name}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="panel-footer">
                                    <form id="messageform" data-href="{{ route('user-vendor-message-load',$conv->id) }}" action="{{route('user-message-post')}}" method="POST">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                                          <input type="hidden" name="conversation_id" value="{{$conv->id}}">
                                          @if($user->id == $conv->sent_user)
                                              <input type="hidden" name="sent_user" value="{{$conv->sent->id}}">
                                              <input type="hidden" name="reciever" value="{{$conv->recieved->id}}">
                                            @else
                                              <input type="hidden" name="reciever" value="{{$conv->sent->id}}">
                                              <input type="hidden" name="recieved_user" value="{{$conv->recieved->id}}">
                                          @endif
            
                                            <textarea class="form-control" name="message" id="wrong-invoice" rows="5" style="resize: vertical;" required="" placeholder="{{ $langg->lang374 }}"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button class="mybtn1 btn btn-success">
                                                {{ $langg->lang375 }}
                                            </button>
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
