@extends('dashboard.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">{{ __('Update') }}</h5>

                <a href="{{ route('coupons.index') }}" class="btn btn-primary">{{ __('Back') }}</a>

            </div>

            <div class="card-body">
                <form action="{{ route('coupons.update', $coupon->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $coupon->id }}">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="CodeInput">{{ __('Code') }}</label>
                                <input type="text" class="form-control" name="code" id="CodeInput"
                                    value="{{ old('code') ?? $coupon->code }}">
                                @error('code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="discountInput">{{ __('Discount') }}</label>
                                <input type="number" class="form-control" name="discount" id="discountInput"
                                    value="{{ old('discount') ?? $coupon->discount }}">
                                @error('discount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="StartAtInput">{{ __('Start At') }}</label>
                                <input type="date" class="form-control" name="start_at" id="StartAtInput"
                                    value="{{ old('start_at') ?? $coupon->start_at }}">
                                @error('start_at')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="EndAtInput">{{ __('End At') }}</label>
                                <input type="date" class="form-control" name="end_at" id="EndAtInput"
                                    value="{{ old('end_at') ?? $coupon->end_at }}">
                                @error('end_at')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="maxTimesInput">{{ __('Max Times') }}</label>
                                <input type="number" class="form-control" name="max_times" id="maxTimesInput"
                                    value="{{ old('max_times') ?? $coupon->max_times }}">
                                @error('max_times')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>




                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="avatarInput">{{ __('Status') }}</label>
                                <select type="file" accept=".jpg,.png" class="form-control" name="is_active"
                                    id="avatarInput" value="{{ old('avatar') }}">
                                    <option value="0" @if (old('is_active') == 0 || $coupon->is_active == 0) selected @endif>
                                        {{ __('Not Active') }}</option>
                                    <option value="1" @if (old('is_active') == 1 || $coupon->is_active == 1) selected @endif>
                                        {{ __('Active') }}</option>
                                </select>
                                @error('avatar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 mt-2 text-end">
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                    </div>

                </form>
            </div>


        </div>

    </div>
@endsection
