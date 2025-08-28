<nav class="navbar navbar-expand-lg mb-4 p-0 py-4 inner-nav inner-nav-lg main-bg-light">
    <div class="container-fluid p-0">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav m-auto">
                <a class="nav-link text-center" href="{{ route('admin-user-index') }}"><img src="{{asset('assets/admin/images/nav/category.webp')}}" class="d-block m-auto mb-3"> <span class="text-white">{{ __('Customers List') }}</span></a>
                <a class="nav-link text-center" href="{{ route('admin-withdraw-index') }}"><img src="{{asset('assets/admin/images/nav/category-1.webp')}}" class="d-block m-auto mb-3"> <span class="text-white">{{ __('Withdraws') }}</span></a>
            </ul>
        </div>
    </div>
</nav>
