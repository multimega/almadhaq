<?php   
    $features= App\Models\Feature::all();
    $l = DB::table('languages')->where('is_default','=',1)->first();
?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Vowalaa LLC">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>{{$gs->title}}</title>
    <!-- favicon -->
    <link rel="icon"  type="image/x-icon" href="{{asset('assets/images/'.$gs->favicon)}}"/>
    <!-- Bootstrap -->
    
    @if($gs->light_dark == 0)
    <!--<link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet" />-->
    @else
    <!--<link href="{{asset('assets/admin/css/light/bootstrap.min.css')}}" rel="stylesheet" />-->
    @endif
    <!-- Fontawesome -->
    <!--<link rel="stylesheet" href="{{asset('assets/admin/css/fontawesome.css')}}">-->
    <link rel="stylesheet" href="{{asset('assets/front/css/toastr.css')}}">
    
    
    <!-- icofont -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/checkbox.css')}}">
    <!--<link rel="stylesheet" href="{{asset('assets/admin/css/icofont.min.css')}}">-->
    <!-- Sidemenu Css -->
    @if($gs->light_dark == 0)
    <link href="{{asset('assets/admin/plugins/fullside-menu/css/dark-side-style.css')}}" rel="stylesheet" />
    @else
    <link href="{{asset('assets/admin/plugins/fullside-menu/css/light/dark-side-style.css')}}" rel="stylesheet" />
    @endif
    <link href="{{asset('assets/admin/plugins/fullside-menu/waves.min.css')}}" rel="stylesheet" />
    
    <!--		<link href="{{asset('assets/admin/css/plugin.css')}}" rel="stylesheet" />
    -->
    <link href="{{asset('assets/admin/css/jquery.tagit.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/admin/js/atag-it.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-coloroicker.css') }}">
    <!-- Main Css -->
    
    <!-- stylesheet -->
    @if(DB::table('admin_languages')->where('is_default','=',1)->first()->rtl == 1)
        @if($gs->light_dark == 1)
            
            <link href="{{asset('assets/admin/rtl/style.css')}}" rel="stylesheet"/>
            <link href="{{asset('assets/admin/css/rtl/customs.css')}}" rel="stylesheet"/>
            <link href="{{asset('assets/admin/rtl/responsive.css')}}" rel="stylesheet" />
        @else
            <link href="{{asset('assets/admin/css/rtl/style.css')}}" rel="stylesheet"/>
            <link href="{{asset('assets/admin/css/rtl/custom.css')}}" rel="stylesheet"/>
            <link href="{{asset('assets/admin/css/rtl/responsive.css')}}" rel="stylesheet" />
        @endif
    @else
    
        @if($gs->light_dark == 1)   
            <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet"/>
            <link href="{{asset('assets/admin/css/light/style_lite.css')}}" rel="stylesheet"/>
            <link href="{{asset('assets/admin/css/light/custom.css')}}" rel="stylesheet"/>
            <link href="{{asset('assets/admin/css/responsive.css')}}" rel="stylesheet" />
        @else
            <link href="{{asset('assets/admin/css/style.css')}}" rel="stylesheet"/>
            <link href="{{asset('assets/admin/css/custom.css')}}" rel="stylesheet"/>
            <link href="{{asset('assets/admin/css/responsive.css')}}" rel="stylesheet" />
        @endif
    @endif
    
    <link href="{{asset('assets/admin/css/common.css')}}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
    @if($gs->light_dark == 0)
        <link href="{{asset('assets/admin/css/plugin.css')}}" rel="stylesheet" />
    @else
        <link href="{{asset('assets/admin/css/light/plugin.css')}}" rel="stylesheet" />
    @endif

    <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/front/css/sweetalert.css')}}">
    <link href="{{asset('assets/admin/css/new-style/bootstrap.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/admin/css/new-style/all.min.css')}}">
    <link href="{{asset('assets/admin/css/new-style/new-style.css')}}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    
    @if(DB::table('admin_languages')->where('is_default','=',1)->first()->rtl == 1)
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link href="{{asset('assets/admin/css/new-style/new-style-rtl.css')}}" rel="stylesheet" />
    @endif
    @yield('styles')
</head>
<body>
    <!-- Start Navbar -->
    @if(Auth::guard('admin')->check())
    <div class="main-top-nav d-flex align-items-start align-items-md-center justify-content-md-between flex-column flex-md-row">
        <div class="d-flex align-items-center justify-content-between top-nav-logo"> 
            <img src="{{asset('assets/admin/images/nav/vowalaa.png')}}" alt="Vowalaa Logo" class="logo">
            <div class="sidebar-btn">
                <img src="{{asset('assets/admin/images/sidebar/elements-icons-menu.svg')}}">
            </div>
        </div>
        <div class="d-flex align-items-center">
            <!-- Start Conversation Notification -->
            <span class="bell-area dropdown">
                <a href="javascript:;"  id="notf_conv" class="icon-container d-flex align-items-center justify-content-center dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="far fa-comment-dots"></i>
                    <span data-href="{{ route('conv-notf-count') }}" id="conv-notf-count">{{ App\Models\Notification::countConversation() }}</span>
                </a>
    			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    				<div class="dropdownmenu-wrapper" data-href="{{ route('conv-notf-show') }}" id="conv-notf-show"></div>
                </div>
            </span>
            <!-- End Conversation Notification -->
            <!-- Start Products in Low Quantity Notification -->
            <span class="bell-area dropdown">
                <a href="javascript:;"  id="notf_product" class="icon-container d-flex align-items-center justify-content-center dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <div>
                        <i class="far fa-bell"></i>
                        <span class="notify-dot"></span>
                    </div>
                    <span data-href="{{ route('product-notf-count') }}" id="product-notf-count">{{ App\Models\Notification::countProduct() }}</span>
                </a>
    			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    				<div class="dropdownmenu-wrapper" data-href="{{ route('product-notf-show') }}" id="product-notf-show"></div>
                </div>
            </span>
            <!-- End Products in Low Quantity Notification -->
            <!-- Start User Notification -->
            <span class="bell-area dropdown">
                <a href="javascript:;"  id="notf_user" class="icon-container d-flex align-items-center justify-content-center dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bullhorn"></i>
                    <span data-href="{{ route('user-notf-count') }}" id="user-notf-count">{{ App\Models\Notification::countRegistration() }}</span>
                </a>
    			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    				<div class="dropdownmenu-wrapper" data-href="{{ route('user-notf-show') }}" id="user-notf-show"></div>
                </div>
            </span>
            <!-- End User Notification -->
            <!-- Start Cart Notification -->
            <span class="bell-area dropdown">
                <a href="javascript:;"  id="notf_order" class="icon-container d-flex align-items-center justify-content-center dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-cart-arrow-down"></i>
                    <span data-href="{{ route('order-notf-count') }}" id="order-notf-count">{{ App\Models\Notification::countOrder() }}</span>
                </a>
    			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    				<div class="dropdownmenu-wrapper" data-href="{{ route('order-notf-show') }}" id="order-notf-show"></div>
                </div>
            </span>
            <!-- End Cart Notification -->
            <div class="separator"></div>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ Auth::guard('admin')->user()->photo ? asset('assets/images/admins/'.Auth::guard('admin')->user()->photo ):asset('assets/images/noimage.png') }}" class="avatar"> <span></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    				<a href="{{ route('admin.profile') }}" class="dropdown-item"><i class="fas fa-user"></i> {{ __('Edit Profile') }}</a>
    				<a href="{{ route('admin.password') }}" class="dropdown-item"><i class="fas fa-cog"></i> {{ __('Change Password') }}</a>
    				<a href="{{ route('admin.logout') }}" class="dropdown-item"><i class="fas fa-power-off"></i> {{ __('Logout') }}</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Navbar -->
    @endif
    <main class="bg-white">
        <!-- Start Sidebar -->
         @if(Auth::guard('admin')->check())

        <div class="side-bar col-20-prec closeSidebar">
            <ul class="list-unstyled">
                <!--<li>-->
                <!--    <a href="#" class="d-flex align-items-center active">-->
                <!--        <i class="fas fa-th-large"></i> Dashboard-->
                <!--    </a>-->
                <!--</li>-->
                <!--<li class="dropdown">-->
                <!--    <a href="#" class="d-flex align-items-center">-->
                <!--        <i class="fas fa-th-large"></i> Suppliers & Customers <i class="fas fa-angle-down arrow"></i>-->
                <!--    </a>-->
                <!--    <ul class="list-unstyled">-->
                <!--        <li><a href="sections_demo.php">Main Choise</a></li>-->
                <!--        <li><a href="sections_demo.php">Test Choise</a></li>-->
                <!--        <li><a href="sections_demo.php">Test Choise 65</a></li>-->
                <!--    </ul>-->
                <!--</li>-->
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-th-large"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/tutorial') }}">
                        <i class="far fa-play-circle"></i> {{ __('Tutorial') }}
                    </a>
                </li>
                @if(Auth::guard('admin')->user()->IsSuper())
				    @include('includes.admin.roles.super')
				@else
				    @include('includes.admin.roles.normal')
				@endif
                <li>
                    <a href="{{ route('admin.main-settings') }}">
                        <i class="fas fa-cogs"></i> {{ __('Settings') }}
                    </a>
                </li>
            </ul>
        </div>
        @endif
        <!-- End Sidebar -->
        <div class="main-sec main-bg col-80-prec">
            @yield('content')
        </div>
    </main>
	
    @php
    	$curr = \App\Models\Currency::where('is_default','=',1)->first();
    @endphp
    <script type="text/javascript">
        var mainurl = "{{url('/')}}";
        var admin_loader = {{ $gs->is_admin_loader }};
        var whole_sell = {{ $gs->wholesell }};
        var getattrUrl = '{{ route('admin-prod-getattributes') }}';
        var curr = {!! json_encode($curr) !!};
    </script>
    <!-- Dashboard Core -->
    <script src="{{asset('assets/admin/js/vendors/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/vendors/vue.js')}}"></script>
    <!--<script src="{{asset('assets/admin/js/vendors/bootstrap.min.js')}}"></script>-->
    <script src="{{asset('assets/admin/js/new-js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/new-js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/new-js/main.js')}}"></script>
    <script src="{{asset('assets/admin/js/jqueryui.min.js')}}"></script>
    <!-- Fullside-menu Js-->
    <script src="{{asset('assets/admin/plugins/fullside-menu/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/fullside-menu/waves.min.js')}}"></script>
    
    <script src="{{asset('assets/admin/js/plugin.js')}}"></script>
    <script src="{{asset('assets/admin/js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/tag-it.js')}}"></script>
    <script src="{{asset('assets/admin/js/nicEdit.js')}}"></script>
    <script src="{{asset('assets/admin/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{asset('assets/admin/js/notify.js') }}"></script>
    
    <script src="{{asset('assets/admin/js/jquery.canvasjs.min.js')}}"></script>
    
    <script src="{{asset('assets/admin/js/load.js')}}"></script>
    <!-- Custom Js-->
    <script src="{{asset('assets/admin/js/custom.js')}}"></script>
    <script src="{{asset('assets/admin/js/toastr.js')}}"></script>
    <script src="{{asset('assets/front/js/toastr.js')}}"></script>
    <!-- AJAX Js-->
    <script src="{{asset('assets/admin/js/myscript.js')}}"></script>
    <script src="{{asset('assets/front/js/sweetalert-dev.js')}}"></script>
    <script src="{{asset('assets/front/js/sweetalert.min.js')}}"></script>
    
    
    <!-- Apex Charts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <!--<script src="{{asset('assets/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>-->
    <!-- <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>-->
    <!--	<script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>-->
    <!--   <script src="{{asset('assets/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>-->
    
    <script>
        tinymce.init({
            selector: '#text',
        });
    </script>
    @yield('scripts')
    
    @if($gs->is_admin_loader == 0)
        <style>
        div#geniustable_processing {
            display: none !important;
        }
        </style>
    @endif
</body>
</html>
