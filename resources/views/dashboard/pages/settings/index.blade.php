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
                        <form action="{{ route('settings.update') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="name_ar">{{ __('Name') }}(AR)</label>
                                        <input id="name_ar" class="form-control" type="text" name="name_ar"
                                            value="{{ $setting->name_ar }}">
                                        @error('name_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="name_en">{{ __('Name') }}(EN)</label>
                                        <input id="name_en" class="form-control" type="text" name="name_en"
                                            value="{{ $setting->name_en }}">
                                        @error('name_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="email">{{ __('Email') }}</label>
                                        <input id="email" class="form-control" type="email" name="email"
                                            value="{{ $setting->email }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="address">{{ __('Address') }}</label>
                                        <input id="address" class="form-control" type="address" name="address"
                                            value="{{ $setting->address }}">
                                        @error('address')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="phone">{{ __('Phone') }}</label>
                                        <input id="phone" class="form-control" type="text" name="phone"
                                            value="{{ $setting->phone }}">
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="facebook">{{ __('Facebook') }}</label>
                                        <input id="facebook" class="form-control" type="text" name="facebook"
                                            value="{{ $setting->facebook }}">
                                        @error('facebook')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="instagram">{{ __('Instagram') }}</label>
                                        <input id="instagram" class="form-control" type="text" name="instagram"
                                            value="{{ $setting->instagram }}">
                                        @error('instagram')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="twitter">{{ __('Twitter') }}</label>
                                        <input id="twitter" class="form-control" type="text" name="twitter"
                                            value="{{ $setting->twitter }}">
                                        @error('twitter')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="google">{{ __('Google') }}</label>
                                        <input id="google" class="form-control" type="text" name="google"
                                            value="{{ $setting->google }}">
                                        @error('google')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="slogan_ar">{{ __('Slogan') }}(AR)</label>
                                        <textarea id="slogan_ar" class="form-control" type="text" name="slogan_ar">{{ $setting->slogan_ar }}</textarea>
                                        @error('slogan_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="slogan_en">{{ __('Slogan') }}(EN)</label>
                                        <textarea id="slogan_en" class="form-control" type="text" name="slogan_en">{{ $setting->slogan_en }}</textarea>
                                        @error('slogan_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="short_description_ar">{{ __('Short_description') }}(AR)</label>
                                        <textarea id="short_description_ar" class="form-control" type="text" name="short_description_ar">{{ $setting->short_description_ar }}</textarea>
                                        @error('short_description_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="short_description_en">{{ __('Short_description') }}(EN)</label>
                                        <textarea id="short_description_en" class="form-control" type="text" name="short_description_en">{{ $setting->short_description_en }}</textarea>
                                        @error('short_description_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="logo">{{ __('Logo') }}</label>
                                        <input id="logo" class="form-control" type="file" name="logo">
                                        @error('logo')
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
