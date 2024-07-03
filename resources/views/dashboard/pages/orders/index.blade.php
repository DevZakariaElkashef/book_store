@extends('dashboard.layouts.app')



@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Order List Widget -->

        <div class="card mb-4">
            <div class="card-widget-separator-wrapper">
                <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1 justify-content-center">
                        @foreach ($orderStatus as $status)
                            <div class="col-sm-2">
                                <div
                                    class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                                    <div>
                                        <h3 class="mb-2">
                                            {{ \App\Models\Order::where('order_status_id', $status->id)->count() }}</h3>
                                        <p class="mb-0">{{ $status->name }}</p>
                                    </div>
                                    <div class="avatar me-sm-4">
                                        <span class="avatar-initial rounded bg-label-secondary">
                                            <i class="mdi mdi-cart mdi-24px"></i>
                                        </span>
                                    </div>
                                </div>
                                <hr class="d-none d-sm-block d-lg-none me-4" />
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        <!-- Order List Table -->
        <div class="card">
            @include('dashboard.pages.orders.table')
        </div>
    </div>
    <!-- / Content -->
@endsection
