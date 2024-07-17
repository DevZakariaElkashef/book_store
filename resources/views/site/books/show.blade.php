@extends('site.layout.app')


@section('content')
    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="{{ route('site.home') }}">{{ __('Home') }}</a></li>
                <li><a
                        href="{{ route('site.universites.show', $book->subject->college->university_id) }}">{{ $book->subject->college->university->name }}</a>
                </li>
                <li><a
                        href="{{ route('site.colleges.show', $book->subject->college_id) }}">{{ $book->subject->college->name }}</a>
                </li>
                <li><a href="{{ route('site.books.show', $book->id) }}">{{ $book->name }}</a></li>

            </ul>
        </div>
    </div>

    <div class="product_details_wrap">
        <div class="container-fluid pd-50">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="product_details_gallery d-flex align-items-start">
                        <div class="horizintal_slider" dir="ltr">
                            <div class="slider_item">
                                <div class="card-img">
                                    <div class="img-parent">
                                        <img src="{{ asset($book->image) }}" alt="">
                                    </div>
                                </div>
                            </div>
                            @foreach ($book->images as $image)
                                <div class="slider_item">
                                    <div class="card-img">
                                        <div class="img-parent">
                                            <img src="{{ asset($image->path) }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="single_slider" dir="ltr">
                            <div class="slider_item">
                                <div class="card-img">
                                    <div class="img-parent">
                                        <img src="{{ asset($book->image) }}" alt="">
                                    </div>
                                </div>
                            </div>
                            @foreach ($book->images as $image)
                                <div class="slider_item">
                                    <div class="card-img">
                                        <div class="img-parent">
                                            <img src="{{ asset($image->path) }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-7">
                    <div class="product_content">
                        <div class="rate">
                            <i class="fas fa-star"></i>
                            <span>4.8</span>
                        </div>
                        <h5>{{ $book->name }}</h5>
                        <h6>{{ $book->subject->college->university->name }} / {{ $book->subject->college->name }}</h6>
                        <div class="description">
                            <h4>{{ __('Description') }}</h4>
                            <p>
                                {{ $book->description }}
                            </p>
                        </div>
                        <div class="price">

                            @if (hasOffer($book->id))
                                <span>{{ $book->offer }} {{ __('SAR') }}</span>
                                <span>{{ $book->price }} {{ __('SAR') }}</span>
                            @else
                                <span>{{ $book->price }} {{ __('SAR') }}</span>
                            @endif






                        </div>
                        <div class="btn_buy">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modaAddAdress"
                                data-id="{{ $book->id }}" data-count="{{ bookCartCount($book->id) }}"
                                data-image="{{ asset($book->image) }}"
                                class="d-inline-flex align-items-center add-to-cart-btn">

                                <i class="fa-solid fa-cart-shopping"></i>
                                <span>{{ __('Add to cart') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product_rate">
        <div class="container-fluid pd-50">
            <div class="wrapper">
                <h5>{{ __('Product ratings and reviews') }}</h5>
                @foreach ($reviews as $review)
                    <div class="rate_card_wrapper">
                        <div class="card_icon">
                            <img width="100"
                                src="{{ $review->orderItem->order->user->avatar ? asset($review->orderItem->order->user->avatar) : asset('site/assets/images/person-rate.png') }}"
                                alt="">
                        </div>
                        <div class="card_body">
                            <h4>{{ $review->orderItem->order->user->name }}</h4>
                            <p class="col-lg-6">
                                {{ $review->comment }}
                            </p>
                            <div class="rate">
                                @for ($i = 0; $i < $review->star; $i++)
                                    <span><i class="far fa-star"></i></span>
                                @endfor
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>

    @if($book->subject->books->where('id', '!=', $book->id)->count())
        <div class="related_product">
            <div class="container-fluid pd-50">
                <div class="wrapper">
                    <div class="section_header">
                        <h5>{{ __('Similar Products') }}</h5>
                    </div>

                    <div class="related_product_slider">

                        @foreach ($book->subject->books->where('id', '!=', $book->id) as $item)
                            <div class="slider_item">
                                <div class="product_card d-flex align-items-start">
                                    <div class="card-img">
                                        <div class="img-parent">
                                            <img src="{{ $item->image }}" alt="">
                                        </div>
                                    </div>
                                    <div class="card-body ms-3">
                                        <h5>{{ $item->name }}</h5>
                                        <p> {{ $item->description }}</p>
                                        @if (hasOffer($item->id))
                                            <span class="price"> {{ $item->offer }} <span
                                                    class="text-decoration-line-through">{{ $item->price }}</span><span>
                                                    {{ __('sar') }}</span></span>
                                        @else
                                            <span class="price"> {{ $item->price }} <span> {{ __('sar') }}</span></span>
                                        @endif
                                        <div class="options">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modaAddAdress"
                                                data-id="{{ $book->id }}" data-count="{{ bookCartCount($book->id) }}"
                                                data-image="{{ asset($book->image) }}"
                                                class="d-inline-flex align-items-center add-to-cart-btn">

                                                <i class="fa-solid fa-cart-shopping"></i>
                                                <span>{{ __('Add to cart') }}</span>
                                            </a>
                                            <a href="{{ route('site.books.show', $book->id) }}">
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
    @endif


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
