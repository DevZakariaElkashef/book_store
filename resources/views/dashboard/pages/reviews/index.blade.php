@extends('dashboard.layouts.app')


@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row mb-4 g-4">
            <div class="col-md-12">
                <div class="card h-100">
                    <div class="card-body row widget-separator">
                        <div class="col-sm-5 border-shift border-end">
                            <div class="d-flex align-items-center mb-3">
                                <span class="text-primary display-5 fw-normal">4.89</span>
                                <span class="mdi mdi-star mdi-24px ms-1 text-primary"></span>
                            </div>
                            <h6>Total {{ $totalCount }} reviews</h6>
                            <p>All reviews are from genuine customers</p>
                            <span class="badge bg-label-primary rounded-pill p-2 mb-3 mb-sm-0">+{{ $totalThisWeek }} This
                                week</span>
                            <hr class="d-sm-none" />
                        </div>

                        <div class="col-sm-7 g-2 text-nowrap d-flex flex-column justify-content-between px-4 gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <small>5 Star</small>
                                <div class="progress w-100 rounded" style="height: 10px">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        style="width: {{ $totalCount ? ($total5Starts * 100) / $totalCount : 0 }}%"
                                        aria-valuenow="61.50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="w-px-20 text-end">{{ $total5Starts }}</small>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <small>4 Star</small>
                                <div class="progress w-100 rounded" style="height: 10px">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        style="width: {{ $totalCount ? ($total4Starts * 100) / $totalCount : 0 }}%"
                                        aria-valuenow="24" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="w-px-20 text-end">{{ $total4Starts }}</small>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <small>3 Star</small>
                                <div class="progress w-100 rounded" style="height: 10px">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        style="width: {{ $totalCount ? ($total3Starts * 100) / $totalCount : 0 }}%"
                                        aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="w-px-20 text-end">{{ $total3Starts }}</small>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <small>2 Star</small>
                                <div class="progress w-100 rounded" style="height: 10px">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        style="width: {{ $totalCount ? ($total2Starts * 100) / $totalCount : 0 }}%"
                                        aria-valuenow="7" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="w-px-20 text-end">{{ $total2Starts }}</small>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <small>1 Star</small>
                                <div class="progress w-100 rounded" style="height: 10px">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        style="width: {{ $totalCount ? ($total1Starts * 100) / $totalCount : 0 }}%"
                                        aria-valuenow="2" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="w-px-20 text-end">{{ $total1Starts }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body row">
                        <div class="col-sm-5">
                            <div class="mb-5">
                                <h4 class="mb-2 text-nowrap">Reviews statistics</h4>
                                <p class="mb-0">
                                    <span class="me-2">12 New reviews</span>
                                    <span class="badge bg-label-success rounded-pill">+8.4%</span>
                                </p>
                            </div>

                            <div>
                                <h6 class="mb-2"><span class="text-success fw-normal me-1">87%</span>Positive reviews</h6>
                                <p class="mb-0">Weekly Report</p>
                            </div>
                        </div>
                        <div class="col-sm-7 d-flex justify-content-end align-items-end">
                            <div id="reviewsChart"></div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

        <!-- review List Table -->
        <div class="card">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-center justify-content-md-end">
                    <div id="DataTables_Table_1_filter" class="dataTables_filter">
                        <label>
                            <input type="search" class="form-control search-in-db"
                                data-url="{{ route('reviews.search') }}" placeholder="{{ __('search...') }}"
                                aria-controls="DataTables_Table_1">
                        </label>
                        {{-- export --}}
                        <a class="dt-button add-new btn bg-label-primary" href="{{ route('reviews.export') }}">
                            <span class="d-none d-sm-inline-block">{{ __('Export') }}</span>
                        </a>
                        {{-- filter --}}
                        <a class="dt-button add-new btn bg-label-primary" href="javascript:void(0);" data-bs-toggle="modal"
                            data-bs-target="#filterModal">
                            <span class="d-none d-sm-inline-block">{{ __('Filter') }}</span>
                        </a>
                    </div>

                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu" style="">
                            <a class="dropdown-item waves-effect delete-selection" data-url="{{ route('reviews.delete') }}"
                                href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                    class="mdi mdi-trash-can-outline me-1"></i> {{ __('Delete') }}</a>
                        </div>
                    </div>

                </div>
            </div>
            <div id="searchTable">
                @include('dashboard.pages.reviews.table')
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
                    <form method="get" action="{{ route('coupons.index') }}">
                        <div class="modal-body">

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



        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">{{ __('Update') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" id="updateReviewForm">
                        @csrf
                        @method('put')
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="starInput">Star</label>
                                <input type="number" class="form-control" name="star" id="starInput">
                                @error('star')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="CommentInput">Comment</label>
                                <textarea class="form-control" name="comment" id="CommentInput"></textarea>
                                @error('comment')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection


@section('js')
    <script>
        $(document).on('click', '.delete-btn', function() {
            $('#deleteForm').attr('action', $(this).data('url'));
        });


        $(document).on('click', '.edit-btn', function(){
            console.log($(this).data('star'));
            console.log($(this).data('comment'));
            console.log($(this).data('url'));
            $('#starInput').val($(this).data('star'));
            $('#CommentInput').text($(this).data('comment'));
            $('#updateReviewForm').attr('action', $(this).data('url'));
        })
    </script>
@endsection
