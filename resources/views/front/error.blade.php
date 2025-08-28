@extends('layouts.front')
@section('content')
<style>
    .error-page{
            background: #f7f7f7
    }
    .error-page h1{
        color: #b08c50;
    }
    @media only screen and (max-width: 767px){
        .error-page h1{
            font-size: 24px;
        }
    }
</style>
<div class="error-page">
    <div class="container py-5">
        <h1 class="text-center">
            @if($langg->rtl != "1")
                An error occurred while paying
                <br>
                Please try again
            @else
                لقد حدث خطأ عند الدفع 
                <br>
                يرجاء المحاولة مرة أخرى 
            @endif
        </h1>
    </div>
</div>

@endsection