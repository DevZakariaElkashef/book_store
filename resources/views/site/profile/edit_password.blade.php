@extends('site.layout.app')

@section('content')
    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="{{ route('site.home') }}">{{ __("Home") }}</a></li>
                <li><a href="{{ route('site.profile.index') }}">{{ __('Personal profile') }}</a></li>
            </ul>
        </div>
    </div>


    <div class="main-content home-main-content myaccount-profile ">
        <div class="wrapper">
            <div class="container-fluid pd-50">
                <div class="profile-page">
                    <div class="wrapper">
                        <div class="container">
                            <div class="open-profile-sidebar">
                                <i class="fas fa-bars"></i>
                            </div>
                        </div>
                        <div class="">
                            <div class="row">
                                @include('site.profile._nav')
                                <div class="col-sm-12 col-md-12 col-lg-9">
                                    <div class="profile-left-data">
                                        <div class="profile-user-data">
                                            <div class="head text-center">
                                                <h5>{{ __('Personal profile') }}</h5>
                                            </div>
                                            <form action="{{ route('site.password.update') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <div class="row">

                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="old_password">{{ __('Old Password') }}</label>
                                                            <input type="password" name="old_password" id="old_password"
                                                                class="form-control">

                                                            @error('old_password')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="new_password">{{ __('New Password') }}</label>
                                                            <input type="password" name="new_password" id="new_password"
                                                                class="form-control">

                                                            @error('new_password')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label
                                                                for="confirm_password">{{ __('Confirm Password') }}</label>
                                                            <input type="password" name="confirm_password"
                                                                id="confirm_password" class="form-control">
                                                        </div>
                                                    </div>




                                                    <div class="col-sm-12 col-lg-12">
                                                        <div class="btn-options">
                                                            <div class="btn-more">
                                                                <button type="submit"
                                                                    class="btn-style">{{ __('Save') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
