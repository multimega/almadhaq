@extends('layouts.admin')

@section('content')
<div class="content-area">
    @include('includes.form-success')

    
    @if(Session::has('cache'))

        <div class="alert alert-success validation d-flex align-items-center justify-content-between">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">×</span></button>
            <h3 class="text-center">{{ Session::get("cache") }}</h3>
        </div>
    
    
    @endif


    <!-- Overview Boxes -->
    <div class="row mb-5">
        <div class="col-lg-2 col-md-4 mb-2 mb-lg-0">
            <a href="{{route('admin-order-pending')}}">
                <div class="overview-box overview-box-1 text-center">
                    <span class="text-white">{{count($pending)}}</span>
                    <p class="mb-0">{{ __('Orders Pending') }}</p>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 mb-2 mb-lg-0">
            <a href="{{route('admin-order-processing')}}">
                <div class="overview-box overview-box-2 text-center">
                    <span class="text-white">{{count($processing)}}</span>
                    <p class="mb-0">{{ __('Orders Procsessing') }}</p>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 mb-2 mb-lg-0">
            <a href="{{route('admin-order-completed')}}">
                <div class="overview-box overview-box-3 text-center">
                    <span class="text-white">{{count($completed)}}</span>
                    <p class="mb-0">{{ __('Orders Completed') }}</p>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 mb-2 mb-lg-0">
            <a href="{{route('admin-prod-index')}}">
                <div class="overview-box overview-box-4 text-center">
                    <span class="text-white">{{count($products)}}</span>
                    <p class="mb-0">{{ __('Total Products') }}</p>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 mb-2 mb-lg-0">
            <a href="{{route('admin-user-index')}}">
                <div class="overview-box overview-box-5 text-center">
                    <span class="text-white">{{count($users)}}</span>
                    <p class="mb-0">{{ __('Total Customers') }}</p>
                </div>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 mb-2 mb-lg-0">
            <a href="{{route('admin-blog-index')}}">
                <div class="overview-box overview-box-6 text-center">
                    <span class="text-white">{{count($blogs)}}</span>
                    <p class="mb-0">{{ __('Total Posts') }}</p>
                </div>
            </a>
        </div>
    </div>
    <!-- Circle Boxes -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="default-box">
                <div class="default-box-body text-center">
                    <div class="circle-box circle-box-1">
                        <span class="num">{{ App\Models\User::where( 'created_at', '>', Carbon\Carbon::now()->subDays(30))->get()->count()  }}</span>
                        <h3>{{ __('New Customers') }}</h3>
                        <p>{{ __('Last 30 Days') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="default-box">
                <div class="default-box-body text-center">
                    <div class="circle-box circle-box-2">
                        <span class="num">{{ App\Models\User::count() }}</span>
                        <h3>{{ __('Total Customers') }}</h3>
                        <p>{{ __('All Time') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="default-box">
                <div class="default-box-body text-center">
                    <div class="circle-box circle-box-3">
                        <span class="num">{{ App\Models\Order::where('status','=','completed')->where( 'created_at', '>', Carbon\Carbon::now()->subDays(30))->get()->count()  }}</span>
                        <h3>{{ __('Total Sales') }}</h3>
                        <p>{{ __('Last 30 days') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="default-box">
                <div class="default-box-body text-center">
                    <div class="circle-box circle-box-4">
                        <span class="num">{{ App\Models\Order::where('status','=','completed')->get()->count() }}</span>
                        <h3>{{ __('Total Sales') }}</h3>
                        <p>{{ __('All Time') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Chatt Boxes -->
    <div class="row">
        <div class="col-lg-6">
            <div class="default-box">
                <div class="default-box-body">
                    <div id="chartContainer-topReference"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="default-box">
                <div class="default-box-body">
                    <div id="chartContainer-os"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tables Box -->
    <div class="row">
        <!-- Recent Orders Table -->
        <div class="col-lg-6">
            <div class="default-box">
                <div class="default-box-head d-flex align-items-center justify-content-between">
                    <h4>{{ __('Recent Order(s)') }}</h4>
                </div>
                <div class="default-box-body">
                    <div class="table-responsive">
                        <table class="table table-overview">
                            <tbody>
                                @foreach($rorders as $data)
                                <tr>
                                    <td><i class="fas fa-file-signature main-bg-dark sq-box"></i></td>
                                    <td>
                                        <h6>{{ __('Order Number') }}</h6>
                                        <span class="email">{{ $data->order_number }}</span>
                                    </td>
                                    <td>
                                        <h6>{{ __('Order Date') }}</h6>
                                        <span class="email">{{ date('Y-m-d',strtotime($data->created_at)) }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin-order-show',$data->id) }}" class="main-light-btn">
                                            <i class="fas fa-eye"></i> {{ __('Details') }}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Recent Orders Table -->
        <div class="col-lg-6">
            <div class="default-box">
                <div class="default-box-head d-flex align-items-center justify-content-between">
                    <h4>{{ __('Recent Customer(s)') }}</h4>
                </div>
                <div class="default-box-body">
                    <div class="table-responsive">
                        <table class="table table-overview">
                            <tbody>
                                @foreach($rusers as $data)
                                <tr>
                                    <td><i class="fas fa-users main-bg-dark sq-box"></i></td>
                                    <td>
                                        <h6>{{ __('Customer Email') }}</h6>
                                        <span class="email">{{ $data->email }}</span>
                                    </td>
                                    <td>
                                        
                                        <h6>{{ __('Joined') }}</h6>
                                        <span>{{ $data->created_at }}</span>
                                    <td>
                                        <a href="{{ route('admin-user-show',$data->id) }}" class="main-light-btn">
                                            <i class="fas fa-eye"></i> {{ __('Details') }}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Popular Products Table -->
        <div class="col-lg-12">
            <div class="default-box">
                <div class="default-box-head d-flex align-items-center justify-content-between">
                    <h4>{{ __('Popular Product(s)') }}</h4>
                </div>
                <div class="default-box-body">
                    <div class="table-responsive">
                        <table class="table table-overview">
                            <tbody>
                                @foreach($poproducts as $data)
                                <tr>
                                    <td>
                                        <h6>{{ __('Featured Image') }}</h6>
                                        <span><img src="{{filter_var($data->photo, FILTER_VALIDATE_URL) ?$data->photo:asset('assets/images/products/'.$data->photo)}}"></span>
                                    </td>
                                    <td>
                                        <h6>{{ __('Name') }}</h6>
                                        <span>{{  strlen(strip_tags($data->name)) > 50 ? substr(strip_tags($data->name),0,50).'...' : strip_tags($data->name) }}</span>
                                    </td>
                                    <td>
                                        <h6>{{ __('Category') }}</h6>
                                        <span>
                                            {{ $data->category->name ?? ''}} 
                                            @if(isset($data->subcategory))
                                            <br>
                                            {{ $data->subcategory->name }}
                                            @endif
                                            @if(isset($data->childcategory))
                                            <br>
                                            {{ $data->childcategory->name }}
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <h6>{{ __('Type') }}</h6>
                                        <span>{{ $data->type }}</span>
                                    </td>
                                    <td>
                                        <h6>{{ __('Price') }}</h6>
                                        <span>{{ $data->showPrice() }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin-prod-edit',$data->id) }}" class="main-light-btn">
                                            <i class="fas fa-eye"></i> {{ __('Details') }}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Recent Products Table -->
        <div class="col-lg-12">
            <div class="default-box">
                <div class="default-box-head d-flex align-items-center justify-content-between">
                    <h4>{{ __('Recent Product(s)') }}</h4>
                </div>
                <div class="default-box-body">
                    <div class="table-responsive">
                        <table class="table table-overview">
                            <tbody>
                                @foreach($pproducts as $data)
                                <tr>
                                    <td>
                                        <h6>{{ __('Featured Image') }}</h6>
                                        <span><img src="{{filter_var($data->photo, FILTER_VALIDATE_URL) ?$data->photo:asset('assets/images/products/'.$data->photo)}}"></span>
                                    </td>
                                    <td>
                                        <h6>{{ __('Name') }}</h6>
                                        <span>{{  strlen(strip_tags($data->name)) > 50 ? substr(strip_tags($data->name),0,50).'...' : strip_tags($data->name) }}</span>
                                    </td>
                                    <td>
                                        <h6>{{ __('Category') }}</h6>
                                        <span>
                                            @if(isset($data->category))
                                            {{ $data->category->name }}
                                            @endif
                                            
                                            @if(isset($data->subcategory))
                                            <br>
                                            {{ $data->subcategory->name }}
                                            @endif
                                            @if(isset($data->childcategory))
                                            <br>
                                            {{ $data->childcategory->name }}
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <h6>{{ __('Type') }}</h6>
                                        <span>{{ $data->type }}</span>
                                    </td>
                                    <td>
                                        <h6>{{ __('Price') }}</h6>
                                        <span>{{ $data->showPrice() }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin-prod-edit',$data->id) }}" class="main-light-btn">
                                            <i class="fas fa-eye"></i> {{ __('Details') }}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cards-one">

        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <h5 class="card-header">{{ __('Total Sales in Last 30 Days') }}</h5>
                <div class="card-body">

                    <canvas id="lineChart"></canvas>

                </div>
            </div>

        </div>

    </div>





</div>

@endsection

@section('scripts')

<script language="JavaScript">
    displayLineChart();

    function displayLineChart() {
        var data = {
            labels: [
            {!!$days!!}
            ],
            datasets: [{
                label: "Prime and Fibonacci",
                fillColor: "#3dbcff",
                strokeColor: "#0099ff",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: [
                {!!$sales!!}
                ]
            }]
        };
        var ctx = document.getElementById("lineChart").getContext("2d");
        var options = {
            responsive: true
        };
        var lineChart = new Chart(ctx).Line(data, options);
    }


    
</script>

<script type="text/javascript">
    $('#poproducts').dataTable( {
      "ordering": false,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false,
          'responsive'  : true,
          'paging'  : false
    } );
    </script>


<script type="text/javascript">
    $('#pproducts').dataTable( {
      "ordering": false,
      'lengthChange': false,
          'searching'   : false,
          'ordering'    : false,
          'info'        : false,
          'autoWidth'   : false,
          'responsive'  : true,
          'paging'  : false
    } );
    </script>

<script type="text/javascript">
    // Apex Charts
    
    // Chart Total Referrals
    var topReferralsCount = [];
    var topReferralsName = [];
    @foreach($referrals as $browser)
        topReferralsCount.push({{$browser->total_count}});
        topReferralsName.push("{{$browser->referral}}");
    @endforeach
    var options1 = {
        series: topReferralsCount,
        chart: {
            height: 300,
            type: 'pie',
            zoom: {
                enabled: false
            }, 
            toolbar: {
                show: true,
                offsetX: 0,
                offsetY: 0,
                tools: {
                    download: true,
                },
                export: {
                    csv: {
                        filename: undefined,
                        columnDelimiter: ',',
                        headerCategory: 'category',
                        headerValue: 'value',
                        dateFormatter(timestamp) {
                            return new Date(timestamp).toDateString()
                        }
                    },
                    svg: {
                        filename: undefined,
                    },
                    png: {
                        filename: undefined,
                    }
                },
            },
        },
        labels: topReferralsName,
        responsive: [{
            breakpoint: 480,
                options: {
                chart: {
                    width: '100%'
                },
                legend: {
                    position: 'bottom',
                }
            }
        }],
        title: {
            text: 'Top Referrals',
            margin: 15,
            align: 'left',
            style: {
                color: '#002547',
                fontSize: '17px',
                fontWeight: '600',
            },
        },
    };
    var chart1 = new ApexCharts(document.querySelector("#chartContainer-topReference"), options1);
    chart1.render();
    
    
    // Chart Most Used OS
    var browserCount = [];
    var browserName = [];
    @foreach($browsers as $browser)
        browserCount.push({{$browser->total_count}});
        browserName.push("{{$browser->referral}}");
    @endforeach
    
    var options2 = {
        series: browserCount,
        chart: {
            height: 300,
            type: 'pie',
            zoom: {
                enabled: false
            }, 
            toolbar: {
                show: true,
                offsetX: 0,
                offsetY: 0,
                tools: {
                    download: true,
                },
                export: {
                    csv: {
                        filename: undefined,
                        columnDelimiter: ',',
                        headerCategory: 'category',
                        headerValue: 'value',
                        dateFormatter(timestamp) {
                            return new Date(timestamp).toDateString()
                        }
                    },
                    svg: {
                        filename: undefined,
                    },
                    png: {
                        filename: undefined,
                    }
                },
            },
        },
        labels: browserName,
        responsive: [{
            breakpoint: 480,
                options: {
                chart: {
                    width: '100%'
                },
                legend: {
                    position: 'bottom'
                }
            }
        }],
        title: {
            text: 'Most Used OS',
            margin: 15,
            align: 'left',
            style: {
                color: '#002547',
                fontSize: '17px',
                fontWeight: '600',
            },
        },
    };

    var chart2 = new ApexCharts(document.querySelector("#chartContainer-os"), options2);
    chart2.render();
</script>

@endsection