@extends('site.layout.app')


@section('content')
    <div class="bredcrumb_inner_page">
        <div class="card-img">
            <div class="img-parent">
                <img src="{{ asset($heroImg) }}" alt="">
            </div>
            <div class="container-fluid pd-50">
                <div class="breadcrumb_content">
                    <h5>{{ __('Offers and discounts') }}</h5>
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
                <li><a href="{{ route('site.home') }}">{{ __('Home') }}</a></li>
                <li><a href="{{ route('site.books.offers') }}">{{ __('Offers and discounts') }}</a></li>
            </ul>
        </div>
    </div>


    <div class="offers_page">
        <div class="container-fluid pd-50">
            <div class="section_header mt-5">
                <img src="{{ asset('site/assets/images/book2.svg') }}" alt="">
                <span class="ms-2">{{ __('Offers and discounts') }}</span>
            </div>


            <div class="offers_page_cards">
                <div class="row">
                    @foreach ($books as $book)
                        <div class="col-6 col-md-6 col-lg-6 col-xl-4">
                            <div class="product_card d-flex align-items-start">
                                <div class="card-img">
                                    <div class="img-parent">
                                        <img src="{{ asset($book->image) }}" alt="">
                                    </div>
                                </div>
                                <div class="card-body ms-3">
                                    <h5>{{ $book->name }}</h5>
                                    <p> {{ Str::limit($book->description, $strLimit) }} </p>
                                    @if (hasOffer($book->id))
                                        <span class="price"> {{ $book->offer }} <span
                                                class="text-decoration-line-through">{{ $book->price }}</span><span>
                                                {{ __('sar') }}</span></span>
                                    @else
                                        <span class="price"> {{ $book->price }} <span> {{ __('sar') }}</span></span>
                                    @endif
                                    <div class="options">
                                        <a href="#" onclick="$('#addToCartForm{{ $book->id }}').submit()"
                                            class="d-inline-flex align-items-center">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                            <span>{{ __('Add to cart') }}</span>
                                        </a>
                                        <form id="addToCartForm{{ $book->id }}" class="d-none"
                                            action="{{ route('carts.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        </form>
                                        <a href="{{ route('site.favourite.toggle', ['book_id' => $book->id]) }}">
                                            @if (hasFavourite(auth()->user(), $book->id))
                                                <i class="fa-solid fa-heart"></i>
                                            @else
                                                <i class="fa-regular fa-heart"></i>
                                            @endif
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
@endsection
