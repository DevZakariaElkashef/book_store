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
                                <a href="{{ route('orders.index', ['type' => $status->id]) }}">
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
                                </a>
                                <hr class="d-none d-sm-block d-lg-none me-4" />
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        <!-- Order List Table -->
        <div class="card">

            <div class="card-header">
                <h5 class="card-title">{{ __('Orders') }}</h5>

                <div class="row align-items-end">
                    <div class="col-sm-12 col-md-6">

                    </div>
                    <div class="col-sm-12 d-flex justify-content-center justify-content-md-end">
                        <div id="DataTables_Table_1_filter" class="dataTables_filter">
                            <label>
                                <input type="search" class="form-control search-in-db"
                                    data-url="{{ route('orders.search') }}" placeholder="{{ __('search...') }}"
                                    aria-controls="DataTables_Table_1">
                            </label>
                            {{-- export --}}
                            <a class="dt-button add-new btn bg-label-primary" href="{{ route('orders.export') }}">
                                <span class="d-none d-sm-inline-block">{{ __('Export') }}</span>
                            </a>
                            {{-- filter --}}
                            <a class="dt-button add-new btn bg-label-primary" href="javascript:void(0);"
                                data-bs-toggle="modal" data-bs-target="#filterModal">
                                <span class="d-none d-sm-inline-block">{{ __('Filter') }}</span>
                            </a>
                            {{-- add order btn --}}
                        </div>

                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item waves-effect delete-selection"
                                    data-url="{{ route('orders.delete') }}" href="javascript:void(0);"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                        class="mdi mdi-trash-can-outline me-1"></i> {{ __('Delete') }}</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div id="searchTable">
                @include('dashboard.pages.orders.table')
            </div>
        </div>
    </div>
    <!-- / Content -->
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">{{ __('Delete') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="ids" id="ids">

                    <div class="modal-body">
                        {{ __('Are You Sure!!') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="filterModalLabel">{{ __('Filter') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="get" action="{{ route('orders.index') }}">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="from">{{ __('From') }}</label>
                            <input type="date" class="form-control" name="from" id="from"
                                value="{{ request()->has('from') ? request()->from : '' }}">
                            @error('from')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="to">{{ __('To') }}</label>
                            <input type="date" class="form-control" name="to" id="to"
                                value="{{ request()->has('to') ? request()->to : '' }}">
                            @error('to')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
