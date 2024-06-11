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
                                <h4>Sliders</h4>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#createModal">Create</a>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item waves-effect delete-selection"
                                                data-url="{{ route('sliders.delete') }}" href="javascript:void(0);"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                                    class="mdi mdi-trash-can-outline me-1"></i> {{ __('Delete') }}</a>
                                        </div>
                                    </div>
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
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">{{ __('Create') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="createForm" action="{{ route('sliders.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="title_ar">Title(AR)</label>
                                    <input id="title_ar" class="form-control" type="text" name="title_ar">
                                    @error('title_ar')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="title_en">Title(EN)</label>
                                    <input id="title_en" class="form-control" type="text" name="title_en">
                                    @error('title_en')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="content_ar">Content(AR)</label>
                                    <textarea id="content_ar" class="form-control"name="content_ar"></textarea>
                                    @error('content_ar')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="content_en">Content(EN)</label>
                                    <textarea id="content_en" class="form-control"name="content_en"></textarea>
                                    @error('content_en')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="url">URL</label>
                                    <input id="url" type="url" class="form-control"name="url">
                                    @error('url')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="is_active">Status</label>
                                    <select id="is_active" class="form-control"name="is_active">
                                        <option value="0">{{ __('Not Active') }}</option>
                                        <option value="1"> {{ __('Active') }}</option>
                                    </select>
                                    @error('is_active')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input id="image" class="form-control" type="file" accept=".jpg,.png,.jpeg"
                                        name="image">
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
                        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="edit_title_ar">Title(AR)</label>
                                    <input id="edit_title_ar" class="form-control" type="text" name="title_ar">
                                    @error('title_ar')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="edit_title_en">Title(EN)</label>
                                    <input id="edit_title_en" class="form-control" type="text" name="title_en">
                                    @error('title_en')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="edit_content_ar">Content(AR)</label>
                                    <textarea id="edit_content_ar" class="form-control"name="content_ar"></textarea>
                                    @error('content_ar')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="edit_content_en">Content(EN)</label>
                                    <textarea id="edit_content_en" class="form-control"name="content_en"></textarea>
                                    @error('content_en')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="edit_url">URL</label>
                                    <input id="edit_url" type="url" class="form-control"name="url">
                                    @error('url')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="edit_is_active">Status</label>
                                    <select id="edit_is_active" class="form-control"name="is_active">
                                        <option value="0">{{ __('Not Active') }}</option>
                                        <option value="1"> {{ __('Active') }}</option>
                                    </select>
                                    @error('is_active')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label for="image">Image</label>
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
