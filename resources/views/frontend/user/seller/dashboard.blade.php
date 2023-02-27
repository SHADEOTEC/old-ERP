@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="aiz-titlebar mt-2 mb-2">
        <div class="row align-items-center">
            <div class="col-md-4">
                <h1 class="h3">{{ translate('Dashboard') }}</h1>
            </div>
        </div>
    </div>

    <form class="" action="{{ route('seller.products') }}" method="GET">
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" class="form-control" id="search" name="search" placeholder="{{ translate('Search product name') }}">
            </div>
            <div class="col-md-2">
                <input type="submit" class="form-control btn btn-danger" value="Search" />
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-start" style="gap: 2rem">
                <div class="h3 fw-700">
                    <a href="{{ route('seller.products') }}" class="btn btn-info" style="">
                        <span class="glyphicon glyphicon-th-list">Create New Order</span>
                    </a>
                </div>
                <a class="btn btn-success" style="border-color: #604cbb;margin-bottom: 0.5rem;background-color: #604cbb;color: white;" href="{{ route('seller.products.bulk') }}"> Create a Bulk Order </a>
            </div>
        </div>
    </form>

    <div class="row gutters-10">

        <div class="col-md-3">
            <div class="bg-grad-3 mb-4 overflow-hidden rounded-lg text-white" style="background-color:#CD6C43;">
                <div class="px-3 pt-3">
                    <div class="h3 fw-700">
                        @if (isset($t_products))
                            <a href="{{ route('seller.products') }}" style="color:white;">{{ $t_products }}</a>
                        @else
                            0
                        @endif
                    </div>
                    <div class="opacity-50">{{ translate('Products') }}</div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="opacity: 0;">
                    <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                          d="M0,192L26.7,192C53.3,192,107,192,160,202.7C213.3,213,267,235,320,218.7C373.3,203,427,149,480,117.3C533.3,85,587,75,640,90.7C693.3,107,747,149,800,149.3C853.3,149,907,107,960,112C1013.3,117,1067,171,1120,202.7C1173.3,235,1227,245,1280,213.3C1333.3,181,1387,107,1413,69.3L1440,32L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z">
                    </path>
                </svg>
            </div>
        </div>

        <div class="col-md-3">
            <div class="bg-grad-1 mb-4 overflow-hidden rounded-lg text-white">
                <div class="px-3 pt-3">
                    <div class="h3 fw-700">
                        @if (isset($t_orders_pending))
                            <a href="{{ route('orders.index', ['status' => 'Pending']) }}" style="color:white;">{{ $t_orders_pending }}</a>
                        @else
                            0
                        @endif
                    </div>
                    <div class="opacity-50">{{ translate('Pending Orders') }}</div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="opacity: 0;">
                    <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                          d="M0,192L30,208C60,224,120,256,180,245.3C240,235,300,181,360,144C420,107,480,85,540,96C600,107,660,149,720,154.7C780,160,840,128,900,117.3C960,107,1020,117,1080,112C1140,107,1200,85,1260,74.7C1320,64,1380,64,1410,64L1440,64L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z">
                    </path>
                </svg>
            </div>
        </div>

        <div class="col-md-3">
            <div class="bg-grad-2 mb-4 overflow-hidden rounded-lg text-white">
                <div class="px-3 pt-3">
                    <div class="h3 fw-700">
                        @if (isset($total_orders))
                            <a href="{{ route('orders.index', ['status' => '']) }}" style="color:white;">{{ $total_orders }}</a>
                        @else
                            0
                        @endif
                    </div>
                    <div class="opacity-50">{{ translate('Total Orders') }}</div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="opacity: 0;">
                    <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                          d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z">
                    </path>
                </svg>
            </div>
        </div>

        <div class="col-md-3">
            <div class="bg-grad-3 mb-4 overflow-hidden rounded-lg text-white">
                <div class="px-3 pt-3">
                    <div class="h3 fw-700">
                        @if (isset($t_orders_success))
                            <a href="{{ route('orders.index', ['status' => 'Ready']) }}" style="color:white;">{{ $t_orders_success }}</a>
                        @else
                            0
                        @endif
                    </div>
                    <div class="opacity-50">{{ translate('Orders Ready') }}</div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="opacity: 0;">
                    <path fill="rgba(255,255,255,0.3)" fill-opacity="1"
                          d="M0,192L26.7,192C53.3,192,107,192,160,202.7C213.3,213,267,235,320,218.7C373.3,203,427,149,480,117.3C533.3,85,587,75,640,90.7C693.3,107,747,149,800,149.3C853.3,149,907,107,960,112C1013.3,117,1067,171,1120,202.7C1173.3,235,1227,245,1280,213.3C1333.3,181,1387,107,1413,69.3L1440,32L1440,320L1413.3,320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,320,27,320L0,320Z">
                    </path>
                </svg>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
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
    </div>

    <div class="row gutters-10">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="fs-14 mb-0" style="font-weight: bold">{{ translate('Product Purchased') }}</h6>
                </div>
                <div class="card-body">
                    <canvas id="graph-1" class="w-100" height="500"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        AIZ.plugins.chart('#graph-1', {
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
                            fontColor: "#8b8b8b",
                            fontFamily: 'Open Sans',
                            fontSize: 10,
                            beginAtZero: true
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: '#f2f3f8'
                        },
                        ticks: {
                            fontColor: "#8b8b8b",
                            fontFamily: 'Open Sans',
                            fontSize: 10
                        }
                    }]
                },
                legend: {
                    labels: {
                        fontFamily: 'Open Sans',
                        boxWidth: 10,
                        usePointStyle: true
                    },
                    onClick: function() {
                        return '';
                    },
                }
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
