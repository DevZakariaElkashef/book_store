@extends('site.layout.app')

@section('content')
    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="{{ route('site.home') }}">{{ __('Home') }}</a></li>
            </ul>
        </div>
    </div>


    <div class="login-page">
        <div class="container">
            <div class="row m-0 login_container">
                <div class="col-sm-12 col-lg-6 p-0">
                    <div class="login-form">
                        <div class="login-form-head text-center">
                            <h4>{{ __('New password') }}</h4>
                            <p>{{ __('Enter your data to be able to log in') }}</p>
                        </div>
                        <div class="box-form p-0 mt-5">
                            <form action="{{ route('site.check_code.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="email" value="{{ request('email') }}">
                                <h5 class="form-inputs-header text-center mb-3">
                                    {{ __('Enter the code') }}
                                </h5>
                                <div class="form-inputs">
                                    <div class="form-group">
                                        <input type="text" name="otp[]" id="" class="form-control"
                                            placeholder="*" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="otp[]" id="" class="form-control"
                                            placeholder="*" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="otp[]" id="" class="form-control"
                                            placeholder="*" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="otp[]" id="" class="form-control"
                                            placeholder="*" />
                                    </div>
                                </div>
                                <div class="btn-submit btn-signup">
                                    <button type="submit" class="btn-style">{{ __('Confirm the code') }}</button>
                                </div>
                                <div class="col-lg-12">
                                    <div class="dont-hava-account">
                                        <a href="{{ route('site.forget_password') }}"><span>
                                                {{ __("Didn't receive the code?") }}
                                            </span>{{ __('Press here') }}</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 p-0 login-strip_container">
                    <div class="login-strip">
                        <img src="{{ asset($img) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
