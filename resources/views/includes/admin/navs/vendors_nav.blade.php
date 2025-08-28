<nav class="navbar navbar-expand-lg bg-white mb-4 p-0 inner-nav">
    <div class="container-fluid p-0">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav">
                <a class="nav-link" href="{{ route('admin-vendor-index') }}">{{ __('Vendors List') }}</a>
                <a class="nav-link" href="{{ route('admin-vendor-withdraw-index') }}">{{ __('Withdraws') }}</a>
                <a class="nav-link" href="{{ route('admin-vendor-subs') }}">{{ __('Vendor Subscriptions') }}</a>
                <a class="nav-link" href="{{ route('admin-vr-index') }}">{{ __('All Verifications') }}</a>
                <a class="nav-link" href="{{ route('admin-vr-pending') }}">{{ __('Pending Verifications') }}</a>
                <a class="nav-link" href="{{ route('admin-subscription-index') }}">{{ __('Vendor Subscription Plans') }}</a>
            </ul>
        </div>
    </div>
</nav>
