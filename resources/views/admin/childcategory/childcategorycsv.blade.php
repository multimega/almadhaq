@extends('layouts.admin')
@section('styles')

<link href="{{asset('assets/admin/css/product.css')}}" rel="stylesheet"/>

@endsection
@section('content')

<div class="content-area">
    <div class="home-head mb-4 mb-md-5">
        <h3>{{ __("Child Category Bulk Upload") }} <span>Manage your child category bulk upload</span></h3>
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __("Dashboard") }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin-childcat-index') }}">{{ __("All Child Categories") }}</a></li>
                <li class="breadcrumb-item">{{ __("Bulk Upload") }}</li>
            </ol>
        </nav>
    </div>
    @include('includes.admin.navs.bulk_nav')
	<div class="default-box">
		<div class="row">
			<div class="col-lg-12">
                <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                <form id="geniusform" action="{{route('admin-childcat-importsubmit')}}" method="POST" class="text-center" enctype="multipart/form-data">
                    {{csrf_field()}}
                    @include('includes.admin.form-both')  
                    <div class="text-end mb-3">
                        <a class="btn main-dark-btn bg-dark-opacity mb-2" href="{{asset('assets/test-childcategory.xlsx')}}">{{ __("Download Sample Excal") }}</a>
                    </div>
                    <div class="csv-icon">
                        <i class="fas fa-file-csv"></i>
                    </div>
                    <div>
                        <span class="file-btn">
                            <input type="file" id="csvfile" class="d-none" name="csvfile" accept=".csv">
                            <label class="label-file-lg" for="csvfile"><i class="fas fa-plus"></i> Upload File</label>
                        </span>
                    </div>
                    <div class="upload-csv-text">
                        <h3>{{ __("Upload a CSV File") }} *</h3>
                        <p>
                            Convert Excel File To CSV Before Upload it
                            <br>
                            <a style="color:red" href="https://www.beautifyconverter.com/excel-to-csv-converter.php" target="_blank">Convert Excel To CSV</a>
                        </p>
                    </div>
                    <input type="hidden" name="type" value="Physical">
    				<div class="row">
    					<div class="col-lg-12 mt-4 text-center">
    						<button class="btn btn-success mr-5" type="submit">{{ __("Start Import") }}</button>
    					</div>
    				</div>
    			</form>
			</div>
		</div>
	</div>
</div>



@endsection

@section('scripts')
<script>
$('#csvfile').change(function() {
    $(this).siblings('label').text($(this)[0].files[0].name);
});
</script>
<script src="{{asset('assets/admin/js/product.js')}}"></script>
@endsection