@extends('dashboard.layouts.app')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <!-- Categories -->
            @include('dashboard.pages.settings.inc.__nav')
            <!-- /Categories -->

            <!-- Article -->
            <div class="col-xl-9 col-lg-8 col-md-8">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="">
                                <h4>{{ __("Sliders") }}</h4>
                            </div>

                        </div>
                        <div id="searchTable">
                            @include('dashboard.pages.settings.sliders.table')
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Article -->
        </div>
    </div>
    <!-- / Content -->

    <!-- Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModalLabel">{{ __('Update') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="updateForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="image">{{ __("Image") }}</label>
                                    <input id="image" class="form-control" type="file" accept=".jpg,.png,.jpeg"
                                        name="image">
                                    <img id="edit_image" alt="" style="max-width: 100px;">
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

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
    <script src="{{ asset('dashboard/assets/js/app-coupon-list.js') }}"></script>

    <script>
        $(document).on('click', '.delete-btn', function() {
            $('#deleteForm').attr('action', $(this).data('url'));
        });


        $(document).on('click', '.edit-btn', function() {
            $('#updateForm').attr('action', $(this).data('url'));

            $('#edit_title_ar').val($(this).data('title_ar'));
            $('#edit_title_en').val($(this).data('title_en'));
            $('#edit_content_ar').val($(this).data('content_ar'));
            $('#edit_content_en').val($(this).data('content_en'));
            $('#edit_url').val($(this).data('link'));
            $('#edit_image').attr('src', $(this).data('image'));

            $('#edit_is_active').val($(this).data('is_active') ? '1' : '0');
        });
    </script>
@endsection
