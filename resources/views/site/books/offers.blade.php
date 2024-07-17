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
                                    <a href="{{ route('site.books.show', $book->id) }}">

                                        <div class="img-parent">
                                            <img src="{{ asset($book->image) }}" alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="card-body ms-3">

                                    <a class="text-dark" href="{{ route('site.books.show', $book->id) }}">
                                        <h5>{{ $book->name }}</h5>
                                        <p> {{ Str::limit($book->description, $strLimit) }} </p>
                                        @if (hasOffer($book->id))
                                            <span class="price"> {{ $book->offer }} <span
                                                    class="text-decoration-line-through">{{ $book->price }}</span><span>
                                                    {{ __('sar') }}</span></span>
                                        @else
                                            <span class="price"> {{ $book->price }} <span>
                                                    {{ __('sar') }}</span></span>
                                        @endif
                                    </a>

                                    <div class="options">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modaAddAdress"
                                            data-id="{{ $book->id }}" data-count="{{ bookCartCount($book->id) }}"
                                            data-image="{{ asset($book->image) }}"
                                            class="d-inline-flex align-items-center add-to-cart-btn">

                                            <i class="fa-solid fa-cart-shopping"></i>
                                            <span>{{ __('Add to cart') }}</span>
                                        </a>
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


    <div class="adress_modal">
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade moda_map" id="modaAddAdress" tabindex="-1" aria-labelledby="modaAddAdressLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">

                        <div class="close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times-circle"></i>
                        </div>

                        <div class="section_header text-center">
                            <h5>{{ __('Add product to cart') }}</h5>
                        </div>
                        <div class=" col-lg-6 mx-auto">
                            <div class="">
                                <form action="{{ route('carts.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" class="inputId">
                                    <div class="product_card">
                                        <div class="card-img">
                                            <div class="img-parent">
                                                <img class="image-cart-modal" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="buy_basket">
                                        <div class="form-group">
                                            <span class="numbutton input-number-increment"
                                                data-bind="click: increment">+</span>
                                            <input type="number" class="form-control numinput" id="num1"
                                                value="1" min="0" name="count">
                                            <span class="numbutton input-number-decrement"
                                                data-bind="click: decrement">-</span>
                                        </div>
                                    </div>


                                    <div class="options mt-5">
                                        <button type="submit"
                                            class="mx-3 btn btn-primary confirm-add-to-cart">{{ __('confirm') }}</button>
                                        <button type="button" class=" mx-3 btn btn-secondary">{{ __('Cancle') }}</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).on('click', '.add-to-cart-btn', function() {
            $('.image-cart-modal').attr('src', $(this).data('image'));
            $('.numinput').val($(this).data('count'));
            $('.inputId').val($(this).data('id'));
        });
    </script>
@endsection
