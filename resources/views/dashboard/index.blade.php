@extends('dashboard.layouts.app')

@section('title')
    Dashboard - Analytics
@endsection

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-4">
            <!-- Gamification Card -->
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="d-flex align-items-end row">
                        <div class="col-md-6 order-2 order-md-1">
                            <div class="card-body">
                                <h4 class="card-title pb-xl-2">{{ __('Congratulations') }} {{ auth()->user()->name }}!🎉</h4>
                                <p class="mb-0">{{ __('You have done') }} <span
                                        class="h6 mb-0">{{ $todaySalePercent }}%</span>😎
                                    {{ __('more sales today') }}.</p>
                                <p>{{ __('Check your new badge in your profile') }}.</p>
                                <a href="{{ route('orders.index') }}" class="btn btn-primary">{{ __('View Orders') }}</a>
                            </div>
                        </div>
                        <div class="col-md-6 text-center text-md-end order-1 order-md-2">
                            <div class="card-body pb-0 px-0 px-md-4 ps-0">
                                <img src="{{ asset('dashboard/assets/img/illustrations/illustration-john-light.png') }}"
                                    height="180" alt="View Profile"
                                    data-app-light-img="illustrations/illustration-john-light.png"
                                    data-app-dark-img="illustrations/illustration-john-dark.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Gamification Card -->

            <!-- Statistics Total Order -->
            <div class="col-lg-2 col-sm-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded">
                                    <i class="mdi mdi-cart-plus mdi-24px"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-info mt-4 pt-1 mt-lg-1 mt-xl-4">
                            <h5 class="mb-2">{{ $totalOrders }}</h5>
                            <p class="mb-lg-2 mb-xl-3">{{ __('Total Orders') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Total Order -->

            <!-- Statistics Total Order -->
            <div class="col-lg-2 col-sm-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded">
                                    <i class="mdi mdi-cart-plus mdi-24px"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-info mt-4 pt-1 mt-lg-1 mt-xl-4">
                            <h5 class="mb-2">{{ $totalUniversities }}</h5>
                            <p class="mb-lg-2 mb-xl-3">{{ __('Total Universities') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Total Order -->

            <!-- Statistics Total Order -->
            <div class="col-lg-2 col-sm-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded">
                                    <i class="mdi mdi-cart-plus mdi-24px"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-info mt-4 pt-1 mt-lg-1 mt-xl-4">
                            <h5 class="mb-2">{{ $totalColleges }}</h5>
                            <p class="mb-lg-2 mb-xl-3">{{ __('Total Colleges') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Total Order -->


            <!-- Statistics Total Order -->
            <div class="col-lg-2 col-sm-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded">
                                    <i class="mdi mdi-cart-plus mdi-24px"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-info mt-4 pt-1 mt-lg-1 mt-xl-4">
                            <h5 class="mb-2">{{ $totalBooks }}</h5>
                            <p class="mb-lg-2 mb-xl-3">{{ __('Total Books') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Total Order -->

            <!-- Statistics Total Order -->
            <div class="col-lg-2 col-sm-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded">
                                    <i class="mdi mdi-cart-plus mdi-24px"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-info mt-4 pt-1 mt-lg-1 mt-xl-4">
                            <h5 class="mb-2">{{ $totalUsers }}</h5>
                            <p class="mb-lg-2 mb-xl-3">{{ __('Total Clients') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Total Order -->

            <!-- Statistics Total Order -->
            <div class="col-lg-2 col-sm-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded">
                                    <i class="mdi mdi-cart-plus mdi-24px"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-info mt-4 pt-1 mt-lg-1 mt-xl-4">
                            <h5 class="mb-2">{{ $totalEmployees }}</h5>
                            <p class="mb-lg-2 mb-xl-3">{{ __('Total Employees') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Statistics Total Order -->




            <!-- Project Statistics -->
            <div class="col-md-6 col-xl-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">{{ __('Most Saled Books') }}</h5>
                    </div>
                    <div class="d-flex justify-content-between py-2 px-4 border-bottom">
                        <h6 class="mb-0 small">{{ __('Name') }}</h6>
                        <h6 class="mb-0 small">{{ __('Cost') }}</h6>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            @foreach ($mostSaledBooks as $book)
                                <li class="d-flex mb-4">
                                    <div class="avatar avatar-md flex-shrink-0 me-3">
                                        <div class="avatar-initial bg-lighter rounded">
                                            <div>
                                                <a href="{{ route('books.edit', $book->id) }}">

                                                    <img src="{{ $book->image ? asset($book->image) : asset('dashboard/assets/img/icons/misc/3d-illustration.png') }}"
                                                        alt="Book Image" class="h-25" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $book->name }}</h6>
                                            <small>{{ $book->subject->name }}</small>
                                        </div>
                                        @php
                                            // Calculate total sales for the book
                                            $orderItems = \App\Models\OrderItem::where('book_id', $book->id)->get();
                                            $totalSales = 0;

                                            foreach ($orderItems as $item) {
                                                $totalSales += $item->qty * $item->price;
                                            }
                                        @endphp
                                        <div class="badge bg-label-primary rounded-pill">${{ $totalSales }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Project Statistics -->



            <!-- Project Statistics -->
            <div class="col-md-6 col-xl-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">{{ __('Most Saled Users') }}</h5>
                    </div>
                    <div class="d-flex justify-content-between py-2 px-4 border-bottom">
                        <h6 class="mb-0 small">{{ __('Name') }}</h6>
                        <h6 class="mb-0 small">{{ __('Cost') }}</h6>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            @foreach ($mostUserOrdered as $user)
                                <li class="d-flex mb-4">
                                    <div class="avatar avatar-md flex-shrink-0 me-3">
                                        <div class="avatar-initial bg-lighter rounded">
                                            <div>
                                                <a href="{{ route('users.edit', $user->id) }}">

                                                    <img src="{{ $user->avatar ? asset($user->avatar) : asset('dashboard/assets/img/icons/misc/3d-illustration.png') }}"
                                                        alt="User avatar" class="h-25" />
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $user->name }}</h6>
                                        </div>
                                        <div class="badge bg-label-primary rounded-pill">
                                            ${{ $user->orders->sum('total') }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Project Statistics -->


            <!-- Sales Country Chart -->
            <div class="col-12 col-xl-4 col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">{{ __("Sales Country") }}</h5>
                        </div>
                        <p class="mb-0 text-body">{{ __("Total") }} ${{ $totalOrders }} {{ __('Sales') }}</p>
                    </div>
                    <div class="card-body pb-1 px-0">
                        <div id="salesCountryChart"></div>
                    </div>
                </div>
            </div>
            <!--/ Sales Country Chart -->

            <!-- Top Referral Source  -->
            <div class="col-12">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-title m-0">
                            <h5 class="mb-1">{{ __("Products with less stock") }}</h5>
                        </div>
                    </div>
                    <div class="card-body pb-3">
                        @include('dashboard.pages.books.table', ['books' => $bookWithLessStock])
                    </div>
                </div>
            </div>
            <!--/ Top Referral Source  -->
        </div>
    </div>
    <!-- / Content -->
@endsection


@section('js')
    <script>
        (function() {
            let cardColor, labelColor, headingColor, borderColor, bodyColor;

            if (isDarkStyle) {
                cardColor = config.colors_dark.cardColor;
                labelColor = config.colors_dark.textMuted;
                headingColor = config.colors_dark.headingColor;
                borderColor = config.colors_dark.borderColor;
                bodyColor = config.colors_dark.bodyColor;
            } else {
                cardColor = config.colors.cardColor;
                labelColor = config.colors.textMuted;
                headingColor = config.colors.headingColor;
                borderColor = config.colors.borderColor;
                bodyColor = config.colors.bodyColor;
            }


            // Sales Country Bar Chart
            // --------------------------------------------------------------------
            const salesCountryChartEl = document.querySelector('#salesCountryChart'),
                salesCountryChartConfig = {
                    chart: {
                        type: 'bar',
                        height: 368,
                        parentHeightOffset: 0,
                        toolbar: {
                            show: false
                        }
                    },
                    series: [{
                        name: 'Sales',
                        data: @json($totalCitySales)
                    }],
                    plotOptions: {
                        bar: {
                            borderRadius: 10,
                            barHeight: '60%',
                            horizontal: true,
                            distributed: true,
                            startingShape: 'rounded',
                            dataLabels: {
                                position: 'bottom'
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        textAnchor: 'start',
                        offsetY: 8,
                        offsetX: 11,
                        style: {
                            fontWeight: 500,
                            fontSize: '0.9375rem',
                            fontFamily: 'Inter'
                        }
                    },
                    tooltip: {
                        enabled: false
                    },
                    legend: {
                        show: false
                    },
                    colors: [
                        config.colors.primary,
                        config.colors.success,
                        config.colors.warning,
                        config.colors.info,
                        config.colors.danger
                    ],
                    grid: {
                        strokeDashArray: 8,
                        borderColor,
                        xaxis: {
                            lines: {
                                show: true
                            }
                        },
                        yaxis: {
                            lines: {
                                show: false
                            }
                        },
                        padding: {
                            top: -18,
                            left: 21,
                            right: 33,
                            bottom: 10
                        }
                    },
                    xaxis: {
                        categories: @json($cityNames),
                        labels: {
                            formatter: function(val) {
                                return Number(val / 1000) + 'K';
                            },
                            style: {
                                fontSize: '0.9375rem',
                                colors: labelColor,
                                fontFamily: 'Inter'
                            }
                        },
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                fontWeight: 500,
                                fontSize: '0.9375rem',
                                colors: headingColor,
                                fontFamily: 'Inter'
                            }
                        }
                    },
                    states: {
                        hover: {
                            filter: {
                                type: 'none'
                            }
                        },
                        active: {
                            filter: {
                                type: 'none'
                            }
                        }
                    }
                };
            if (typeof salesCountryChartEl !== undefined && salesCountryChartEl !== null) {
                const salesCountryChart = new ApexCharts(salesCountryChartEl, salesCountryChartConfig);
                salesCountryChart.render();
            }
        })();
    </script>
@endsection
