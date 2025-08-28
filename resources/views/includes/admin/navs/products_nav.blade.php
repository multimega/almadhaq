<nav class="navbar navbar-expand-lg bg-white mb-4 p-0 inner-nav">
    <div class="container-fluid p-0">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav">
                <a class="nav-link" href="{{ route('admin-prod-index') }}">{{ __('All Products') }}</a>
                <a class="nav-link" href="{{ route('admin-cat-index') }}">{{ __('Categories & Brands') }}</a>
                <a class="nav-link" href="{{ route('admin-import-index') }}">{{ __('Affiliate Products') }}</a>
                <a class="nav-link" href="{{ route('admin-prod-deactive') }}">{{ __('Deactivated Product') }}</a>
                <a class="nav-link" href="{{ route('admin-prod-catalog-index') }}">{{ __('Product Catalogs') }}</a>
                <a class="nav-link" href="{{ route('admin-rating-index') }}">{{ __('Product Reviews') }}</a>
                <a class="nav-link" href="{{ route('admin-comment-index') }}">{{ __('Comments') }}</a>
                <a class="nav-link" href="{{ route('admin-report-index') }}">{{ __('Reports') }}</a>
            </ul>
        </div>
    </div>
</nav>
