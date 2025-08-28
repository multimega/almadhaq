@extends('layouts.admin') 
<style>
    .tutorial{
        background: #f0f8ff;
        border: 1px solid #ccc;
        overflow: hidden;
    }
    .tut-sec-head{
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 15px;
        background: #fff;
    }
    .tutorial > div > h3{
        background: #fff;
        margin: 0;
    }
    .tutorial .tut-link{
        border: 1px solid #ccc;
        padding: 5px 10px;
        font-weight: bold;
        background: #f7f7f7;
        border-radius: 5px;
    }
    .tutorial .row{
        border-top:1px solid #ccc;
    }
    .tutorial li{
        display: flex;
        align-items: center;
        padding: 25px 20px;
        background: #fff;
        border: 1px solid #ccc;
        cursor: pointer;
        font-weight: bold;
        transition: all .3s eas-in-out;
    }
    .tutorial li{
        border-top: 0;
    }
    .tutorial li:hover,
    .tutorial li.active{
        background-color: #f0f8ff;
        border-right: 3px solid #1572e8;
        border-left: 0;
    }
    .tutorial li i{
        color: #1572e8;
        font-size: 21px;
        margin: 0 6px;
    }
    .hidden-class{
        display: none;
    }
    .tut-container{
        display: flex;
        justify-content: space-between;
        padding: 25px 15px 0;
    }
    .tut-container p{
        font-weight: 500;
    }
    .tut-container a.main-btn{
        background: #1572e8;
        padding: 10px 20px;
        border-radius: 25px;
        color: #fff;
        margin-top: 25px;
        margin-bottom: 15px;
        display: inline-block;
        transition: all .3s ease-in-out;
    }
    .tut-container a.main-btn:hover{
        background: #1365ce;
    }
    .tut-container a.read-more-btn{
        border: 1px solid #1572e8;
        padding: 10px 20px;
        border-radius: 20px;
        margin: 0 10px;
        display: inline-block;
        transition: all .3s ease-in-out;
    }
    .tut-container a.read-more-btn:hover{
        background: #1572e8;
        color: #fff;
    }
    @media only screen and (min-width: 992px) and (max-width: 1099px){
        .tutorial li{
            padding: 25px 10px;
            font-size: 13px;
        }
    }
    @media only screen and (max-width: 991px){
        .hidden-classes h3{
            padding: 10px;
        }
    }
    @media only screen and (max-width: 767px){
        .tut-container{
            display: block;
        }
        .tutorial a.read-more-btn{
            margin: 0 0 15px;
        }
    }
    
</style>
@section('content') 

<input type="hidden" id="headerdata" value="{{ __('ORDER') }}">
 
                    <div class="content-area">
                        <div class="mr-breadcrumb">
                            <div class="row">
                                <div class="col-lg-12">
                                        <h4 class="heading">Tutorial</h4>
                                        <ul class="links">
                                            <li>
                                                <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('admin/tutorial') }}">Tutorial</a>
                                            </li>
                                        </ul>
                                </div>
                            </div>
                        </div>
                        <div class="product-area">
                           <div class="tutorial">
                                <div class="tut-sec-head">
                                    <h3>Start Your utorial</h3>
                                    <a href="#" class="tut-link">Skip the Tutorial</a>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <ul class="list-unstyled">
                                            <li class="active" data-id="business-info"><i class="fas fa-business-time"></i> Business Information</li>
                                            <li data-id="create-category"><i class="fas fa-folder-plus"></i> Create a Category</li>
                                            <li data-id="create-product"><i class="fas fa-ribbon"></i> Create a Product</li>
                                            <li data-id="setup-credit-card"><i class="fas fa-credit-card"></i> Setup your Checkout</li>
                                            <li data-id="choose-theme"><i class="fas fa-palette"></i> Choose a Theme</li>
                                            <li data-id="go-live"><i class="fas fa-satellite-dish"></i> Go Live</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-9 hidden-classes">
                                        <div id="business-info">
                                            <div class="tut-container">
                                                <div>
                                                    <h4>Enter your business information</h4>
                                                    <p>Get started by entering some basic information about your business such as your company name, address and telephone number.</p>
                                                    <p>You can also upload your logo here as well.</p>
                                                    <a href="#" class="main-btn">Enter Your information</a>
                                                    <a href="#" class="read-more-btn"><i class="fas fa-info-circle"></i> Read More about it</a>
                                                </div>
                                                <div>
                                                    <img src="https://via.placeholder.com/200">
                                                </div>
                                            </div>
                                            <div class="tut-container pt-0">
                                                <div>
                                                    <h4>Configure VAT settings</h4>
                                                    <p>If you're VAT registered then you'll need to tell us and then also select whether product pricing you enter is inclusive or exclusive of VAT.</p>
                                                    <a href="#" class="main-btn">Enter Your information</a>
                                                    <a href="#" class="read-more-btn"><i class="fas fa-info-circle"></i> Read More about it</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="hidden-class" id="create-category">
                                            <div class="tut-container">
                                                <div>
                                                    <h4>Enter your business information</h4>
                                                    <p>Get started by entering some basic information about your business such as your company name, address and telephone number.</p>
                                                    <p>You can also upload your logo here as well.</p>
                                                    <a href="#" class="main-btn">Enter Your information</a>
                                                    <a href="#" class="read-more-btn"><i class="fas fa-info-circle"></i> Read More about it</a>
                                                </div>
                                                <div>
                                                    <img src="https://via.placeholder.com/200">
                                                </div>
                                            </div>
                                            <div class="tut-container pt-0">
                                                <div>
                                                    <h4>Configure VAT settings</h4>
                                                    <p>If you're VAT registered then you'll need to tell us and then also select whether product pricing you enter is inclusive or exclusive of VAT.</p>
                                                    <a href="#" class="main-btn">Enter Your information</a>
                                                    <a href="#" class="read-more-btn"><i class="fas fa-info-circle"></i> Read More about it</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hidden-class" id="create-product">
                                            <div class="tut-container">
                                                <div>
                                                    <h4>Enter your business information</h4>
                                                    <p>Get started by entering some basic information about your business such as your company name, address and telephone number.</p>
                                                    <p>You can also upload your logo here as well.</p>
                                                    <a href="#" class="main-btn">Enter Your information</a>
                                                    <a href="#" class="read-more-btn"><i class="fas fa-info-circle"></i> Read More about it</a>
                                                </div>
                                                <div>
                                                    <img src="https://via.placeholder.com/200">
                                                </div>
                                            </div>
                                            <div class="tut-container pt-0">
                                                <div>
                                                    <h4>Configure VAT settings</h4>
                                                    <p>If you're VAT registered then you'll need to tell us and then also select whether product pricing you enter is inclusive or exclusive of VAT.</p>
                                                    <a href="#" class="main-btn">Enter Your information</a>
                                                    <a href="#" class="read-more-btn"><i class="fas fa-info-circle"></i> Read More about it</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hidden-class" id="setup-credit-card">
                                            <div class="tut-container">
                                                <div>
                                                    <h4>Enter your business information</h4>
                                                    <p>Get started by entering some basic information about your business such as your company name, address and telephone number.</p>
                                                    <p>You can also upload your logo here as well.</p>
                                                    <a href="#" class="main-btn">Enter Your information</a>
                                                    <a href="#" class="read-more-btn"><i class="fas fa-info-circle"></i> Read More about it</a>
                                                </div>
                                                <div>
                                                    <img src="https://via.placeholder.com/200">
                                                </div>
                                            </div>
                                            <div class="tut-container pt-0">
                                                <div>
                                                    <h4>Configure VAT settings</h4>
                                                    <p>If you're VAT registered then you'll need to tell us and then also select whether product pricing you enter is inclusive or exclusive of VAT.</p>
                                                    <a href="#" class="main-btn">Enter Your information</a>
                                                    <a href="#" class="read-more-btn"><i class="fas fa-info-circle"></i> Read More about it</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hidden-class" id="choose-theme">
                                            <div class="tut-container">
                                                <div>
                                                    <h4>Enter your business information</h4>
                                                    <p>Get started by entering some basic information about your business such as your company name, address and telephone number.</p>
                                                    <p>You can also upload your logo here as well.</p>
                                                    <a href="#" class="main-btn">Enter Your information</a>
                                                    <a href="#" class="read-more-btn"><i class="fas fa-info-circle"></i> Read More about it</a>
                                                </div>
                                                <div>
                                                    <img src="https://via.placeholder.com/200">
                                                </div>
                                            </div>
                                            <div class="tut-container pt-0">
                                                <div>
                                                    <h4>Configure VAT settings</h4>
                                                    <p>If you're VAT registered then you'll need to tell us and then also select whether product pricing you enter is inclusive or exclusive of VAT.</p>
                                                    <a href="#" class="main-btn">Enter Your information</a>
                                                    <a href="#" class="read-more-btn"><i class="fas fa-info-circle"></i> Read More about it</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="hidden-class" id="go-live">
                                            <div class="tut-container">
                                                <div>
                                                    <h4>Enter your business information</h4>
                                                    <p>Get started by entering some basic information about your business such as your company name, address and telephone number.</p>
                                                    <p>You can also upload your logo here as well.</p>
                                                    <a href="#" class="main-btn">Enter Your information</a>
                                                    <a href="#" class="read-more-btn"><i class="fas fa-info-circle"></i> Read More about it</a>
                                                </div>
                                                <div>
                                                    <img src="https://via.placeholder.com/200">
                                                </div>
                                            </div>
                                            <div class="tut-container pt-0">
                                                <div>
                                                    <h4>Configure VAT settings</h4>
                                                    <p>If you're VAT registered then you'll need to tell us and then also select whether product pricing you enter is inclusive or exclusive of VAT.</p>
                                                    <a href="#" class="main-btn">Enter Your information</a>
                                                    <a href="#" class="read-more-btn"><i class="fas fa-info-circle"></i> Read More about it</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



@endsection    

@section('scripts')
<script>
    
    $('.tutorial li').click(function () {
        $('#' + $(this).data('id')).show();
        $('#' + $(this).data('id')).siblings().hide();
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
    });
</script>

    
@endsection   