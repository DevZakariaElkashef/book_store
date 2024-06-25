@extends('site.layout.app')

@section('content')
    <div class="bredcrumb_inner_page">
        <div class="card-img">
            <div class="img-parent">
                <img src="{{ asset('site/assets/images/bredcrumb.png') }}" alt="">
            </div>
            <div class="container-fluid pd-50">
                <div class="breadcrumb_content">
                    <h5>من نحن</h5>
                    <p class="col-lg-6 mx-auto">
                        “لوريم ايبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور
                    </p>
                </div>
            </div>
        </div>

    </div>

    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="{{ route('site.home') }}">الرئيسية</a></li>
                <li><a href="{{ route('site.aboutus.index') }}">من نحن</a></li>
            </ul>
        </div>
    </div>


    <div class="who_us_section">
        <div class="container-fluid pd-50">
            <div class="section_header d-flex align-items-center">
                <img src="{{ asset('site/assets/images/book2.svg') }}" alt="">
                <h2>{{ __("about_us") }}</h2>
            </div>
            @foreach ($abouts as $about)
                <div class="row align-items-center mt-3">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="who_us_section_content">

                            <div class="card_text col-lg-11 col-lg-9">
                                <p>
                                    {{ $about->content }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="about_img">
                            <div class="card-img">
                                <div class="img-parent">
                                    <img src="{{ asset($about->image) }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
