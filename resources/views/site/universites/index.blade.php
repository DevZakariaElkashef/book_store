@extends('site.layout.app')

@section('content')
    <div class="bredcrumb_inner_page">
        <div class="card-img">
            <div class="img-parent">
                <img src="{{ asset($heroImg) }}" alt="">
            </div>
            <div class="container-fluid pd-50">
                <div class="breadcrumb_content">
                    <h5>{{ __("Universities") }}</h5>
                    <p class="col-lg-6 mx-auto">
                        {{ $app->short_description }}
                    </p>
                </div>
            </div>
        </div>

    </div>

    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="{{ route('site.home') }}">{{ __("Home") }}</a></li>
                <li><a href="{{ route("site.universites.index") }}">{{ __("Universities") }}</a></li>
            </ul>
        </div>
    </div>


    <div class="universty_cards">
        <div class="container-fluid pd-50">
            <div class="row">
                @foreach ($universities as $university)
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <a href="{{ route('site.universites.show', $university->id) }}" class="univerisity_card">
                            <div class="card_icon">
                                <img src="{{ $university->image ? asset($university->image) : asset('site/assets/images/uni1.png') }}"
                                    alt="">
                            </div>
                            <div class="card_title">
                                <h5>{{ $university->name }}</h5>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
