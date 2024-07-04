@extends('site.layout.app')

@section('content')
    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="{{ route('site.home') }}">{{ __("Home") }}</a></li>
                <li><a href="{{ route('site.profile.index') }}">{{ __('Profile') }}</a></li>
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
                                    <div class="product_cards">
                                        <div class="row">

                                            @foreach ($favourites->items as $item)
                                                <div class="col-6 col-md-6 col-lg-6 col-xl-4">
                                                    <div class="product_card d-flex align-items-start">
                                                        <div class="card-img">
                                                            <div class="like active_like">

                                                                <a
                                                                    href="{{ route('site.favourite.toggle', ['book_id' => $item->book->id]) }}">
                                                                    @if (hasFavourite(auth()->user(), $item->book->id))
                                                                        <i class="fa-solid fa-heart"></i>
                                                                    @else
                                                                        <i class="fa-regular fa-heart"></i>
                                                                    @endif
                                                                </a>
                                                            </div>
                                                            <div class="img-parent">
                                                                <img src="{{ asset($item->book->image) }}" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="card-body ms-3">
                                                            <h5>{{ $item->book->name }}</h5>
                                                            <p>{{ Str::limit($item->book->description, $strLimit) }}</p>
                                                            <span class="price">{{ $item->book->price }} <span>
                                                                    {{ __('sar') }}</span></span>
                                                            <div class="options">
                                                                <a href="#"
                                                                    onclick="$('#addToCartForm{{ $item->book->id }}').submit()"
                                                                    class="d-inline-flex align-items-center">
                                                                    <form id="addToCartForm{{ $item->book->id }}"
                                                                        class="d-none" action="{{ route('carts.store') }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="book_id"
                                                                            value="{{ $item->book->id }}">
                                                                    </form>
                                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                                    <span>{{ __("Add to cart") }}</span>
                                                                </a>
                                                                <a href="#">
                                                                    <i class="far fa-eye"> </i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

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
