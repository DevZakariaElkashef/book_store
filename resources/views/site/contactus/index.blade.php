@extends('site.layout.app')

@section('content')
    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="">الرئيسية</a></li>
                <li><a href="">تواصل معنا</a></li>
            </ul>
        </div>
    </div>

    <div class="contact_us" style="background-image: url({{ asset('site/assets/images/contact-bg.png') }});">
        <div class="container-fluid pd-50">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-7">
                    <div class="contact_us_conent">
                        <h5 class="head">اتصل بنا</h5>
                        <p class="col-lg-6">{{ $app->slogan }}</p>
                        <div class="contact_icons">
                            <ul class="list-unstyled d-flex">
                                <li>
                                    <a class="icon">
                                        <div class="wrp">
                                            <i class="fas fa-phone-alt"></i>
                                        </div>
                                        <span href="">{{ $app->phone }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="icon">
                                        <div class="wrp">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <span href="">{{ $app->email }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="contact_form">
                            <form action="{{ route('site.contacts.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="name">أسم المستخدم</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="مروان ابراهيم">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="email">{{ __('Email') }}</label>
                                            <input type="text" name="email" id="email" class="form-control"
                                                placeholder="966 055 356757">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="contact_type_id">الموضوع</label>
                                            <select name="contact_type_id" id="contact_type_id" class="form-control">
                                                @foreach ($contactTypes as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <textarea name="message" class="form-control" placeholder="" id="" cols="30" rows="10"></textarea>
                                            @error('message')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="btn_submit">
                                            <button class="btn" type="submit">ارسال</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-5">
                    <div class="contact_img text-center mt-4">
                        <img src="{{ asset($heroImg) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
