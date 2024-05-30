@extends('dashboard.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('dashboard/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('dashboard/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row g-4 mb-4">
            <div class="col-sm-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="me-1">
                                <p class="text-heading mb-2">Total Books</p>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-2 me-1 display-6">{{ $totalBooksCount }}</h4>
                                    <p class="text-success mb-2">(+{{ $thisMonthPercentage }}%)</p>
                                </div>
                                <p class="mb-0">Last month analytics</p>
                            </div>
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded">
                                    <div class="mdi mdi-account-outline mdi-24px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="me-1">
                                <p class="text-heading mb-2">Active Books</p>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-2 me-1 display-6">{{ $totalActiveBooksCount }}</h4>
                                    <p class="text-success mb-2">(+{{ $thisActiveMonthPercentage }}%)</p>
                                </div>
                                <p class="mb-0">Last week analytics</p>
                            </div>
                            <div class="avatar">
                                <div class="avatar-initial bg-label-danger rounded">
                                    <div class="mdi mdi-account-plus-outline mdi-24px scaleX-n1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="me-1">
                                <p class="text-heading mb-2">Pending Books</p>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-2 me-1 display-6">{{ $totalNotActiveBooksCount }}</h4>
                                    <p class="text-success mb-2">(+{{ $thisNotActiveMonthPercentage }}%)</p>
                                </div>
                                <p class="mb-0">Last month analytics</p>
                            </div>
                            <div class="avatar">
                                <div class="avatar-initial bg-label-warning rounded">
                                    <div class="mdi mdi-account-search mdi-24px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Books List Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">{{ __("Books") }}</h5>

                <div class="row align-items-end">
                    <div class="col-sm-12 col-md-6">

                    </div>
                    <div class="col-sm-12 d-flex justify-content-center justify-content-md-end">
                        <div id="DataTables_Table_1_filter" class="dataTables_filter">
                            <label>
                                <input type="search" class="form-control search-in-db"
                                    data-url="{{ route('books.search') }}" placeholder="{{ __('search...') }}" aria-controls="DataTables_Table_1">
                            </label>
                            {{-- export --}}
                            <a class="dt-button add-new btn bg-label-primary" href="{{ route('books.export') }}">
                                <span class="d-none d-sm-inline-block">{{ __("Export") }}</span>
                            </a>
                            {{-- filter --}}
                            <a class="dt-button add-new btn bg-label-primary" href="javascript:void(0);"
                                data-bs-toggle="modal" data-bs-target="#filterModal">
                                <span class="d-none d-sm-inline-block">{{ __("Filter") }}</span>
                            </a>
                            {{-- add book btn --}}
                            <a class="dt-button add-new btn btn-primary" href="{{ route('books.create') }}">
                                <span>
                                    <i class="mdi mdi-plus me-0 me-sm-1"></i>
                                    <span class="d-none d-sm-inline-block">{{ __("Create") }}</span>
                                </span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <div id="searchTable">
                @include('dashboard.pages.books.table')
            </div>
        </div>



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
                    <form method="get" action="{{ route('books.index') }}">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="university_id">{{ __("University") }}</label>
                                <select class="form-control" name="university_id" id="university_id">
                                    @foreach($universities as $university)
                                        <option value="{{ $university->id }}"
                                            @if(request()->has('university_id') && request()->university_id == $university->id) selected @endif>{{ $university->name }}</option>
                                    @endforeach
                                </select>
                                @error('university_id')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="from">From</label>
                                <input type="date" class="form-control" name="from" id="from"
                                    value="{{ request()->has('from') ? request()->from : '' }}">
                                @error('from')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="to">To</label>
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
    </div>
    <!-- / Content -->
@endsection


@section('js')
    <script src="{{ asset('dashboard/assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('dashboard/assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/app-book-list.js') }}"></script>

    <script>
        $(document).on('click', '.delete-btn', function() {
            $('#deleteForm').attr('action', $(this).data('url'));
        });
    </script>
@endsection
