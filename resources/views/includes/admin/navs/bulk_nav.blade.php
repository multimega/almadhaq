<nav class="navbar navbar-expand-lg mb-4 p-0 py-4 inner-nav inner-nav-lg main-bg-light">
    <div class="container-fluid p-0">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav m-auto">
                <a class="nav-link text-center" href="{{ route('admin-cat-import') }}"><img src="{{asset('assets/admin/images/nav/upload.webp')}}" class="d-block m-auto mb-3"> <span class="text-white">{{ __('Bulk Category Upload') }}</span></a>
                <a class="nav-link text-center" href="{{ route('admin-subcat-import') }}"><img src="{{asset('assets/admin/images/nav/upload.webp')}}" class="d-block m-auto mb-3"> <span class="text-white">{{ __('Bulk Sub Category Upload') }}</span></a>
                <a class="nav-link text-center" href="{{ route('admin-childcat-import') }}"><img src="{{asset('assets/admin/images/nav/upload.webp')}}" class="d-block m-auto mb-3"> <span class="text-white">{{ __('Bulk Child Category Upload') }}</span></a>
                <a class="nav-link text-center" href="{{ route('admin-prod-import') }}"><img src="{{asset('assets/admin/images/nav/upload.webp')}}" class="d-block m-auto mb-3"> <span class="text-white">{{ __('Bulk Product Upload') }}</span></a>
                <a class="nav-link text-center" href="{{ route('admin-user-import') }}"><img src="{{asset('assets/admin/images/nav/upload.webp')}}" class="d-block m-auto mb-3"> <span class="text-white">{{ __('Bulk Customers Upload') }}</span></a>
                <a class="nav-link text-center" href="{{ route('admin-order-import') }}"><img src="{{asset('assets/admin/images/nav/upload.webp')}}" class="d-block m-auto mb-3"> <span class="text-white">{{ __('Bulk Orders Upload') }}</span></a>
            </ul>
        </div>
    </div>
</nav>

<script>
    $(".inner-nav .navbar-collapse").niceScroll({
    cursorwidth: "10",
    cursorcolor: "#5e57a0",
    autohidemode: false,
  });
</script>
<!--<nav class="navbar navbar-expand-lg navbar-light mb-4 d-flex internal-nav" style="overflow-x: auto">-->
<!--  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">-->
<!--    <i class="fas fa-bars"></i>-->
<!--  </button>-->

<!--  <div class="collapse navbar-collapse" id="navbarSupportedContent">-->
<!--    <ul class="navbar-nav mr-auto px-2">-->
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" href="{{ route('admin-cat-import') }}"><i class="fas fa-upload"></i> <span>{{ __('Bulk Category Upload') }}</span></a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" href="{{ route('admin-subcat-import') }}"><i class="fas fa-upload"></i> <span>{{ __('Bulk Sub Category Upload') }}</span></a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" href="{{ route('admin-childcat-import') }}"><i class="fas fa-upload"></i> <span>{{ __('Bulk Child Category Upload') }}</span></a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" href="{{ route('admin-prod-import') }}"><i class="fas fa-upload"></i> <span>{{ __('Bulk Product Upload') }}</span></a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" href="{{ route('admin-user-import') }}"><i class="fas fa-upload"></i> <span>{{ __('Bulk Customers Upload') }}</span></a>-->
<!--        </li>-->
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" href="{{ route('admin-order-import') }}"><i class="fas fa-upload"></i> <span>{{ __('Bulk Orders Upload') }}</span></a>-->
<!--        </li>-->
<!--    </ul>-->
<!--  </div>-->
<!--</nav>-->
