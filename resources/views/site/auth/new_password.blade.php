@extends('site.layout.app')

@section('content')
    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="{{ route('site.home') }}">{{ __("Home") }}</a></li>
            </ul>
        </div>
    </div>


    <div class="login-page">
        <div class="container">
            <div class="row m-0 login_container">
                <div class="col-sm-12 col-lg-6 p-0">
                    <div class="login-form">
                        <div class="login-form-head text-center">
                            <h4>{{ __("New password") }}</h4>
                            <p>{{ __("Enter your data to be able to log in") }}</p>
                        </div>
                        <div class="form_img_1">
                            <img src="./assets/images/login-1.png" alt="">
                        </div>
                        <div class="box-form p-0">
                            <form action="{{ route('site.password.reset') }}" class="p-0" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group w-100">
                                            <i class="fas fa-lock"></i>
                                            <input type="email" name="password" id="password" class="form-control"
                                                placeholder="{{ __("New password") }}">
                                                @error('passwor')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group w-100">
                                            <i class="fas fa-lock"></i>
                                            <input type="password" name="confirm" id="confirm" class="form-control"
                                                placeholder="{{ __("Confirm the new password") }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-5">
                                        <div class="btn-more">
                                            <button type="submit" class="btn-style text-white">{{ __("confirm") }} </button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 p-0 login-strip_container">
                    <div class="login-strip">
                        <img src="site/assets/images/login-img.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
