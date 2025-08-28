<div class="col-lg-2 col-md-3 p-0">
    <ul class="list-unstyled dash-sidebar">
        @php 
            $features= App\Models\Feature::all();
            if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
            {
                $link = "https"; 
                // Here append the common URL characters. 
                $link .= "://"; 
                  
                // Append the host(domain name, ip) to the URL. 
                $link .= $_SERVER['HTTP_HOST']; 
                  
                // Append the requested resource location to the URL 
                $link .= $_SERVER['REQUEST_URI']; 
            }
            else
            {
                $link = "http"; 
                  
                // Here append the common URL characters. 
                $link .= "://"; 
                  
                // Append the host(domain name, ip) to the URL. 
                $link .= $_SERVER['HTTP_HOST']; 
                  
                // Append the requested resource location to the URL 
                $link .= $_SERVER['REQUEST_URI']; 
            }      
        @endphp
        
        <a href="{{ route('user-dashboard-34') }}">
            <li class="{{ $link == route('user-dashboard-34') ? 'active':'' }}">
                <i class="fas fa-user"></i> {{ $langg->lang200 }}
            </li>
        </a>
        <a href="{{ route('user-orders-34') }}">
            <li class="{{ $link == route('user-orders-34') ? 'active':'' }}">
                <i class="fas fa-shopping-cart"></i> {{ $langg->lang201 }}
            </li> 
        </a>
        @if($gs->is_affilate == 1)
        <a href="{{ route('user-affilate-code-34') }}">
            <li class="{{ $link == route('user-affilate-code-34') ? 'active':'' }}">
                <i class="fas fa-network-wired"></i> {{ $langg->lang202 }}
            </li>
        </a>
        <a href="{{route('user-wwt-index-34')}}">
            <li class="{{ $link == route('user-wwt-index-34') ? 'active':'' }}">
                <i class="far fa-credit-card"></i> {{ $langg->lang203 }}
            </li>
        </a>
        @endif
             
        @if($features[0]->status == 1 && $features[0]->active == 1 )
        <a href="{{route('user-promo-codes-34')}}">
            <li class="{{ $link == route('user-promo-codes-34') ? 'active':'' }}">
                <i class="fas fa-certificate"></i> {{ $langg->lang812 }}
            </li> 
        </a>
        @endif
        
        @if($features[2]->status == 1 && $features[2]->active == 1 )
        <a href="{{route('user-wallet-34')}}">
            <li class="{{ $link == route('user-wallet-34') ? 'active':'' }}">
                <i class="far fa-credit-card"></i> {{ $langg->lang811 }}
            </li> 
        </a>
        @endif
        
        @if($features[1]->status == 1 && $features[1]->active == 1 )
        <a href="{{route('user-points-34')}}">
            <li class="{{ $link == route('user-points-34') ? 'active':'' }}">
                <i class="fas fa-gift"></i> {{ $langg->lang809 }}
            </li>
        </a>
        @endif
         
        @if($features[3]->status == 1 && $features[3]->active == 1 )
        <a href="{{route('user-refelar-34')}}">
            <li class="{{ $link == route('user-refelar-34') ? 'active':'' }}">
                <i class="fas fa-network-wired"></i> {{ $langg->lang810 }}
            </li>
        </a>
        @endif
        <a href="{{route('user-favorites-34')}}">
            <li class="{{ $link == route('user-favorites-34') ? 'active':'' }}">
                <i class="far fa-star"></i> {{ $langg->lang231 }}
            </li> 
        </a>
        @if($features[6]->status == 1 && $features[6]->active == 1 )
        <a href="{{route('user-notifications-34')}}">
            <li class="{{ $link == route('user-notifications-34') ? 'active':'' }}">
                <i class="fas fa-bell"></i> {{ $langg->lang807 }}
            </li>
        </a>
        @endif
        <a href="{{route('user-messages-34')}}">
            <li class="{{ $link == route('user-messages-34') ? 'active':'' }}">
                <i class="fas fa-envelope"></i> {{ $langg->lang232 }}
            </li>
        </a>
        <a href="{{route('user-message-index-34')}}">
            <li class="{{ $link == route('user-message-index-34') ? 'active':'' }}">
                <i class="fas fa-envelope"></i> {{ $langg->lang204 }}
            </li>
        </a>
        <a href="{{route('user-dmessage-index-34')}}">
            <li class="{{ $link == route('user-dmessage-index-34') ? 'active':'' }}">
              <i class="fas fa-envelope"></i> {{ $langg->lang250 }}
            </li>
        </a>
        <a href="{{ route('user-profile-34') }}">
            <li class="{{ $link == route('user-profile-34') ? 'active':'' }}">
              <i class="fas fa-user"></i> {{ $langg->lang205 }}
            </li> 
        </a>
        <a href="{{ route('user-address-34') }}">
            <li class="{{ $link == route('user-address-34') ? 'active':'' }}">
                <i class="fas fa-id-card"></i> {{ $langg->lang813 }}
            </li>
        </a>
        <a href="{{ route('user-reset-34') }}">
            <li class="{{ $link == route('user-reset-34') ? 'active':'' }}">
                <i class="fas fa-key"></i> {{ $langg->lang206 }}
            </li>
        </a>
        <a href="{{ route('user-logout') }}">
            <li>
                <i class="fas fa-sign-out-alt"></i> {{ $langg->lang207 }}
            </li>
        </a>
    </ul>
</div>