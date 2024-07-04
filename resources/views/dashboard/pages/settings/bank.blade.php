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
                        <form action="{{ route('banks.update', 1) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input id="name" class="form-control" type="text" name="name"
                                            value="{{ $bank->name }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="number">{{ __('Number') }}</label>
                                        <input id="number" class="form-control" type="text" name="number"
                                            value="{{ $bank->number }}">
                                        @error('number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="iban">{{ __('iban') }}</label>
                                        <input id="iban" class="form-control" type="text" name="iban"
                                            value="{{ $bank->iban }}">
                                        @error('iban')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Article -->
        </div>
    </div>
    <!-- / Content -->
@endsection
