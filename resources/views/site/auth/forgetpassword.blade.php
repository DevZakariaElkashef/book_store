@extends('site.layout.app')

@section('content')
    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="{{ route('site.home') }}">الرئيسية</a></li>
                <li><a href="{{ route('site.forget_password') }}">{{ __('Forget Passwrod') }}</a></li>
            </ul>
        </div>
    </div>


    <div class="login-page">
        <div class="container">
            <div class="row m-0 login_container">
                <div class="col-sm-12 col-lg-6 p-0">
                    <div class="login-form">
                        <div class="login-form-head text-center">
                            <h4>استعادة الرقم السري</h4>
                            <p>ادخل بياناتك حتي تتمكن من الدخول</p>
                        </div>
                        <div class="form_img_1">
                            <img src="{{ asset('site/assets/images/login-1.png') }}" alt="">
                        </div>
                        <div class="box-form p-0">
                            <form action="{{ route('site.send_code') }}" class="p-0">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group w-100 mb-5">
                                            <i class="fas fa-envelope"></i>
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="البريد الالكترويي">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="btn-more mt-5">
                                            <button type="submit" class="btn-style text-white">تسجيل الدخول</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 p-0 login-strip_container">
                    <div class="login-strip">
                        <img src="{{ asset($forgetPasswordImg) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
