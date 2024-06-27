@extends('site.layout.app')

@section('title')
    {{ __('Login Page') }}
@endsection

@section('content')

    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="">الرئيسية</a></li>
                <li><a href="">الجامعات</a></li>
                <li><a href="">جامعة الملك عبد العزيز</a></li>
            </ul>
        </div>
    </div>


    <div class="login-page">
        <div class="container">
            <div class="row m-0 login_container">
                <div class="col-sm-12 col-lg-6 p-0">
                    <div class="login-form">
                        <div class="login-form-head text-center">
                            <h4>تسجيل الدخول</h4>
                            <p>ادخل بياناتك حتي تتمكن من الدخول</p>
                        </div>
                        <div class="form_img_1">
                            <img src="{{ asset('site/assets/images/login-1.png') }}" alt="">
                        </div>
                        <div class="box-form p-0">
                            <form action="{{ route('site.login') }}" class="p-0" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group w-100">
                                            <i class="fas fa-envelope"></i>
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="البريد الالكترويي">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group w-100">
                                            <i class="fas fa-lock"></i>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="كلمة المرور">
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="forget-password">
                                            <a href="{{ route("site.forget_password") }}">نسيت الرقم السري ؟</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="btn-more">
                                            <button type="submit" class="btn-style text-white">تسجيل الدخول</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="dont-hava-account">
                                            <a href="{{ route('site.register_page') }}"><span>ليس لدي حساب</span> إنشاء حساب
                                                جديد</a>
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
