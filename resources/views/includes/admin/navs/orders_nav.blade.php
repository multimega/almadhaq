<nav class="navbar navbar-expand-lg bg-white mb-4 p-0 inner-nav">
    <div class="container-fluid p-0">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav">
                <a class="nav-link" href="{{ route('admin-order-index') }}">{{ __('All Orders') }}</a>
                <a class="nav-link" href="{{ route('admin-order-pending') }}">{{ __('Pending Orders') }}</a>
                <a class="nav-link" href="{{ route('admin-order-processing') }}">{{ __('Processing Orders') }}</a>
                <a class="nav-link" href="{{ route('admin-order-completed') }}">{{ __('Completed Orders') }}</a>
                <a class="nav-link" href="{{ route('admin-order-declined') }}">{{ __('Declined Orders') }}</a>
                <a class="nav-link" href="{{ route('admin-order-report-index-form') }}">{{ __('Order Report') }}</a>
            </ul>
        </div>
    </div>
</nav>
