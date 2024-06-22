@extends('site.layout.app')

@section('title')
    {{ __('Register Page') }}
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
                            <h4>إنشاء حساب جديد</h4>
                            <p>اخبرنا بياناتك لانشاء حساب لك</p>
                        </div>
                        <div class="form_img_1">
                            <img src="{{ asset('site/assets/images/login-1.png') }}" alt="">
                        </div>
                        <div class="box-form p-0">
                            <form action="{{ route('site.register') }}" method="POST" class="p-0"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group personal-img-form-group d-flex align-items-center">
                                            <div class="personal-img">
                                                <div class="per"
                                                    style="background-image: url('{{ asset('site/assets/images/account.webp') }}');">
                                                </div>
                                                <div class="upload-btn-wrapper">
                                                    <button class="btn">
                                                        <img src="{{ asset('site/assets/images/camera.svg') }}"
                                                            alt="">
                                                    </button>
                                                    <input type="file" data-file-upload="" class="personal-img-file"
                                                        name="avatar" />
                                                    @error('avatar')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- <h4 class="personlaimg-h4">رفع صورة</h4> -->
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group w-100">
                                            <i class="fas fa-user"></i>
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="أسم المستخدم">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group w-100">
                                            <i class="fas fa-envelope"></i>
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="البريد الالكتروني">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group w-100">
                                            <i class="fas fa-lock"></i>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="الرقم السري">
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-5">
                                        <div class="mt-3 w-100">
                                            <input type="checkbox" name="term" id="approvecondition" class="text-black"
                                                placeholder="***114">
                                            <label for="approvecondition" class="text-black"> قبول الشروط و الاحاكم
                                            </label>
                                        </div>
                                        @error('term')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="btn-more">
                                            <button type="submit" class="btn-style text-white">تسجيل الدخول</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="dont-hava-account">
                                            <a href="{{ route('site.login_page') }}"><span>بالفعل لدي حساب</span>تسجيل
                                                الدخول</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 p-0 login-strip_container">
                    <div class="login-strip">
                        <img src="{{ asset('site/assets/images/signup-img.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
