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
                        <form action="{{ route('shippings.update') }}" method="post" enctype="multipart/form-data">
                            @csrf


                            <div class="row">

                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label class="switch switch-primary">
                                            <input type="checkbox" name="use_shiping" value="1" class="switch-input" @if($setting->use_shiping) checked @endif>
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="ri-check-line"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="ri-close-line"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">{{ __('Do you use delivery costs') }}</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label
                                            for="free_distance">{{ __('Distance within which shipping is free (in km)') }}</label>
                                        <input id="free_distance" class="form-control" type="number" name="free_distance"
                                            value="{{ $setting->free_distance }}">
                                        @error('free_distance')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label
                                            for="cost_per_km">{{ __('Cost of shipping per km after the free distance') }}</label>
                                        <input id="cost_per_km" class="form-control" type="number" name="cost_per_km"
                                            value="{{ $setting->cost_per_km }}">
                                        @error('cost_per_km')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label
                                            for="non_operational_distance">{{ __('Distance beyond which the service does not operate (in km)') }}</label>
                                        <input id="non_operational_distance" class="form-control" type="number"
                                            name="non_operational_distance"
                                            value="{{ $setting->non_operational_distance }}">
                                        @error('non_operational_distance')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label
                                            for="expected_order_delivered">{{ __('Expected the deliverd in -- days') }}</label>
                                        <input id="expected_order_delivered" class="form-control" type="number"
                                            name="expected_order_delivered"
                                            value="{{ $setting->expected_order_delivered }}">
                                        @error('expected_order_delivered')
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
