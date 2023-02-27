@extends('backend.layouts.app')

@section('content')
    @if (env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null)
        <div class="">
            <div class="alert alert-danger d-flex align-items-center">
                {{ translate('Please Configure SMTP Setting to work all email sending functionality') }},
                <a class="alert-link ml-2" href="{{ route('smtp_settings.index') }}">{{ translate('Configure Now') }}</a>
            </div>
        </div>
    @endif
    @if (Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions)))
        <div class="row gutters-10">
            <div class="col-lg-6">
                <div class="row gutters-10">
                    <div class="col-6">
                        <div class="bg-grad-2 mb-4 overflow-hidden rounded-lg text-white">
                            <div class="px-3 pt-3">
                                <div class="opacity-50">
                                    <span class="fs-12 d-block">{{ translate('Total') }}</span>
                                    {{ translate('Dealers') }}
                                </div>
                                <div class="h3 fw-700 mb-3">
                                    @if (isset($dealers))
                                        <a href="{{ route('backend.sellers.index') }}" style="color:white;">{{ $dealers }}</a>
                                    @else
                                        0
                                    @endif
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                                      d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-grad-3 mb-4 overflow-hidden rounded-lg text-white">
                            <div class="px-3 pt-3">
                                <div class="opacity-50">
                                    <span class="fs-12 d-block">{{ translate('Total') }}</span>
                                    {{ translate('Order') }}
                                </div>
                                <div class="h3 fw-700 mb-3">
                                    @if (isset($orders))
                                        <a href="{{ route('seller_orders.index') }}" style="color:white;">{{ $orders }}</a>
                                    @else
                                        0
                                    @endif
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                                      d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-grad-1 mb-4 overflow-hidden rounded-lg text-white">
                            <div class="px-3 pt-3">
                                <div class="opacity-50">
                                    <span class="fs-12 d-block">{{ translate('Total') }}</span>
                                    {{ translate('Claim / Ticket') }}
                                </div>
                                <div class="h3 fw-700 mb-3">
                                    @if (isset($categories))
                                        <a href="{{ route('support_ticket.admin_index') }}" style="color:white;">{{ $tickets }}</a>
                                    @else
                                        0
                                    @endif
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                                      d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-grad-4 mb-4 overflow-hidden rounded-lg text-white">
                            <div class="px-3 pt-3">
                                <div class="opacity-50">
                                    <span class="fs-12 d-block">{{ translate('Total') }}</span>
                                    {{ translate('Products') }}
                                </div>
                                <div class="h3 fw-700 mb-3">
                                    @if (isset($products))
                                        <a href="{{ route('products.admin') }}" style="color:white;">{{ $products }}</a>
                                    @else
                                        0
                                    @endif
                                </div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                                <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                                      d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-lg-6">
        <div class="row gutters-10">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0 fs-14">{{ translate('Products') }}</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="pie-1" class="w-100" height="305"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0 fs-14">{{ translate('Orders') }}</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="pie-2" class="w-100" height="305"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

            <div class="col-lg-6">
                <div class="card">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex flex-column" style="padding-left: 10px;">
                            <span style="font-weight: 800; font-size: 1.05rem;">Sales</span>
                            <span id="sales-trend-graph-label">Last 12 months</span>
                        </div>
                        <div>
                            <select id="sales-period-select" class="m-2">
                                <option value="12months">Last 12 Months</option>
                                <option value="30days">Last 30 Days</option>
                                <option value="60days">Last 60 Days</option>
                                <option value="90days">Last 90 Days</option>
                                <option value="120days">Last 120 Days</option>
                                <option value="180days">Last 180 Days</option>
                            </select>
                        </div>
                    </div>
                    <div style="width: 100%; height: 300px; padding-inline: 20px;" class="d-flex align-items-center justify-content-center">

                        <canvas id="sales-trend-graph">

                        </canvas>
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if (Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions)))
        <div class="row gutters-10">
            <div class="col-md-6">
                <div class="card">
                    <div class="d-flex flex-column" style="padding-left: 10px;">
                        <span style="font-weight: 800; font-size: 1.05rem;">Sales by Years</span>
                        <span>Net sales last 5 years</span>
                    </div>
                    <div style="width: 100%; height: 300px; padding-inline: 20px;" class="d-flex align-items-center justify-content-center">

                        <canvas id="sales-years-graph">

                        </canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="d-flex flex-column" style="padding-left: 10px;">
                        <span style="font-weight: 800; font-size: 1.05rem;">Category wise Product Sale</span>
                    </div>
                    <div style="width: 100%; height: 320px; padding-inline: 20px;" class="d-flex align-items-center justify-content-center">

                        <canvas id="product-purchase-graph">

                        </canvas>
                    </div>
                </div>
            </div>

        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h6 class="mb-0">{{ translate('Top 12 Products') }}</h6>
        </div>
        <div class="card-body">
            <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4" data-md-items="3" data-sm-items="2" data-arrows='true'>
                @foreach (filter_products(\App\Product::where('state', 'Active')->orderBy('id', 'desc'))->limit(12)->get() as $key => $product)
                    <div class="carousel-box">
                        <div class="aiz-card-box border-light hov-shadow-md has-transition mb-2 rounded border bg-white shadow-sm">
                            <div class="position-relative">
                                <a href="javascript:void(0)" class="d-block">
                                    @if ($product->is_parts == 0)
                                        <img class="img-fit lazyload h-210px mx-auto" src="{{ static_asset('products/images/') . '/' . $product->thumbnail_img }}" data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                             alt="{{ $product->name }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                    @else
                                        <img class="img-fit lazyload h-210px mx-auto" src="{{ static_asset('parts/images/') . '/' . $product->thumbnail_img }}" data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                             alt="{{ $product->name }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                    @endif
                                </a>
                            </div>
                            <div class="p-md-3 p-2 text-left">
                                <div class="fs-15">
                                    @if ($product->is_parts == 1)
                                        <span class="fw-700 text-primary">$ {{ $product->unit_price }}</span>
                                    @else
                                        <span class="fw-700 text-primary">-</span>
                                    @endif
                                </div>
                                <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                    <a href="{{ route('product', $product->slug) }}" class="d-block text-reset">{{ $product->getTranslation('name') }}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        AIZ.plugins.chart('#pie-1', {
            type: 'doughnut',
            data: {
                labels: [
                    '{{ translate('Total Duo Products') }}',
                    '{{ translate('Total Roller products') }}',
                    '{{ translate('Total Uni products') }}',
                    '{{ translate('Total Tri products') }}',
                    '{{ translate('Total Willow products') }}',
                ],
                datasets: [{
                    data: [
                        {{ \DB::table('products')->join('categories', 'categories.id', '=', 'products.category_id')->where('categories.parent_id', '=', 2)->get()->count() }},
                        {{ \DB::table('products')->join('categories', 'categories.id', '=', 'products.category_id')->where('categories.parent_id', '=', 3)->get()->count() }},
                        {{ \DB::table('products')->join('categories', 'categories.id', '=', 'products.category_id')->where('categories.parent_id', '=', 4)->get()->count() }},
                        {{ \DB::table('products')->join('categories', 'categories.id', '=', 'products.category_id')->where('categories.parent_id', '=', 5)->get()->count() }},
                        {{ \DB::table('products')->join('categories', 'categories.id', '=', 'products.category_id')->where('categories.parent_id', '=', 6)->get()->count() }},
                    ],
                    backgroundColor: [
                        "#fd3995",
                        "#34bfa3",
                        "#5d78ff",
                        '#fdcb6e',
                        '#d35400',
                        '#8e44ad',
                        '#006442',
                        '#4D8FAC',
                        '#CA6924',
                        '#C91F37'
                    ]
                }]
            },
            options: {
                cutoutPercentage: 70,
                legend: {
                    labels: {
                        fontFamily: 'Poppins',
                        boxWidth: 10,
                        usePointStyle: true,
                    },
                    onClick: function() {
                        return '';
                    },
                    position: 'bottom'
                }
            }
        });

        AIZ.plugins.chart('#pie-2', {
            type: 'doughnut',
            data: {
                labels: [
                    '{{ translate('Total Ready Orders') }}',
                    '{{ translate('Total Pending Orders') }}',
                    '{{ translate('Total Completed Orders') }}',
                    '{{ translate('Total Cancelled Orders') }}',
                    '{{ translate('Total Success Orders') }}',
                ],
                datasets: [{
                    data: [
                        {{ \App\Models\Xztcart::where('status', 'Ready')->count() }},
                        {{ \App\Models\Xztcart::where('status', 'Pending')->count() }},
                        {{ \App\Models\Xztcart::where('status', 'Completed')->count() }},
                        {{ \App\Models\Xztcart::where('status', 'Cancelled')->count() }},
                        {{ \App\Models\Xztcart::where('status', 'Success')->count() }},
                    ],
                    backgroundColor: [
                        "#fd3995",
                        "#34bfa3",
                        "#5d78ff",
                        '#fdcb6e',
                        '#d35400',
                        '#8e44ad',
                        '#006442',
                        '#4D8FAC',
                        '#CA6924',
                        '#C91F37'
                    ]
                }]
            },
            options: {
                cutoutPercentage: 70,
                legend: {
                    labels: {
                        fontFamily: 'Poppins',
                        boxWidth: 10,
                        usePointStyle: true
                    },
                    onClick: function() {
                        return '';
                    },
                    position: 'bottom'
                }
            }
        });
    </script>

    <script>
        AIZ.plugins.chart('#product-purchase-graph', {
            type: 'bar',
            data: {
                labels: @json($categoryNames),
                datasets: [{
                    label: `Category Purchasing Value`,
                    data: @json($categoryPurchaes),
                    backgroundColor: 'rgba(55, 125, 255, 0.4)',
                    borderColor: 'rgba(55, 125, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: '#f2f3f8',
                            zeroLineColor: '#f2f3f8'
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, ticks) {
                                return '$' + value;
                            },
                            fontFamily: "Open Sans",
                            maxTicksLimit: 3,
                            fontColor: "#8b8b8b",
                            fontSize: 10,
                            beginAtZero: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: '#f2f3f8'
                        },
                        ticks: {
                            fontColor: "#8b8b8b",
                            fontFamily: 'Open Sans',
                            fontSize: 7,
                            fontWeight: "bold",
                        }
                    }]
                },
                legend: {
                    display: false
                },
            }
        });
    </script>

    <script>
        const ctx = document.getElementById('sales-trend-graph').getContext('2d');
        const labels = @json($last12MonthDates);
        const purchaseData = @json($last12MonthsPurchases);

        var myChart = new Chart(ctx, createConfig(labels, purchaseData));

        var last30DaysDates = @json($last30DaysDates);
        var last30DaysPurchases = @json($last30DaysPurchases);
        var last60DaysDates = @json($last60DaysDates);
        var last60DaysPurchases = @json($last60DaysPurchases);
        var last90DaysDates = @json($last90DaysDates);
        var last90DaysPurchases = @json($last90DaysPurchases);
        var last120DaysDates = @json($last120DaysDates);
        var last120DaysPurchases = @json($last120DaysPurchases);
        var last180DaysDates = @json($last180DaysDates);
        var last180DaysPurchases = @json($last180DaysPurchases);


        $("#sales-period-select").change(function() {
            let val = $(this).val();
            $("#sales-trend-graph-label").text($(this).find("option:selected").text())
            if (val === "12months") {
                myChart.destroy()
                myChart = new Chart(ctx, createConfig(labels, purchaseData))
            }
            if (val === "30days") {
                myChart.destroy()
                myChart = new Chart(ctx, createConfig(@json($last30DaysDates), @json($last30DaysPurchases), yMaxTicks = 3, xMaxTicks = 10));
            }
            if (val === "60days") {
                myChart.destroy()
                myChart = new Chart(ctx, createConfig(@json($last60DaysDates), @json($last60DaysPurchases), yMaxTicks = 3, xMaxTicks = 10));
            }
            if (val === "90days") {
                myChart.destroy()
                myChart = new Chart(ctx, createConfig(@json($last90DaysDates), @json($last90DaysPurchases), yMaxTicks = 3, xMaxTicks = 10));
            }
            if (val === "120days") {
                myChart.destroy()
                myChart = new Chart(ctx, createConfig(@json($last120DaysDates), @json($last120DaysPurchases), yMaxTicks = 3, xMaxTicks = 10));
            }
            if (val === "180days") {
                myChart.destroy()
                myChart = new Chart(ctx, createConfig(@json($last180DaysDates), @json($last180DaysPurchases), yMaxTicks = 3, xMaxTicks = 10));
            }
        });

        function createConfig(labels, data, yMaxTicks = 3, xMaxTicks = 12) {
            let [myLabels, myData] = limitDatePoints(labels, data, 20);
            return {
                type: 'line',
                data: {
                    labels: myLabels,
                    datasets: [{
                        label: 'Sales Trends',
                        data: myData,
                        borderColor: "#3f51b5",
                        fill: false,
                        backgroundColor: "#277BC0",
                        pointStyle: 'circle',
                        pointRadius: 3.5,
                        pointHoverRadius: 7,
                        lineTension: 0.2,
                        borderWidth: 2,

                    }],
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(value, index, ticks) {
                                    return '$' + value;
                                },
                                fontFamily: "Open Sans",
                                maxTicksLimit: yMaxTicks,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                callback: function(value, index, ticks) {
                                    return '[' + value + ']';
                                },
                                fontFamily: "Open Sans",
                                maxTicksLimit: xMaxTicks,
                                autoSkip: true,
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                },
                responsive: true,
                maintainAspectRatio: true
            };
        }

        function limitDatePoints(label, data, max = 20) {
            if (label.length <= max) {
                return [label, data];
            }
            let newSize = label.length;
            let limitLabels = [];
            let limitData = [];
            for (let i = 0; i < label.length; i++) {
                if (newSize > max) {
                    if (data[i] == 0) {
                        newSize--;
                        continue;
                    }
                }
                limitLabels.push(label[i]);
                limitData.push(data[i]);
            }

            return [limitLabels, limitData];

        }
    </script>

    <script>
        const yearCtx = document.getElementById('sales-years-graph').getContext('2d');
        const yearLabels = @json($last5YearsDates);
        const yearData = @json($last5YearsData);
        const myYearCahrt = new Chart(yearCtx, {
            type: 'bar',
            data: {
                labels: yearLabels,
                datasets: [{
                    label: 'Yearly Sales',
                    data: yearData,
                    borderColor: "#3f51b5",
                    backgroundColor: "#8391e2de",
                    hoverBackgroundColor: "#8391e2de",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, ticks) {
                                return '$' + value;
                            },
                            fontFamily: "Open Sans",
                            maxTicksLimit: 3,
                        }
                    }]
                },
                legend: {
                    display: false
                },
            },
            responsive: true,
            maintainAspectRatio: true
        })
    </script>
@endsection
