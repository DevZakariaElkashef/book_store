@extends('site.layout.app')

@section('content')
    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="{{ route('site.home') }}">{{ __('Home') }}</a></li>
                <li><a href="{{ route('site.profile.index') }}">{{ __('Personal profile') }}</a></li>
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

                                    <div class="order_cards">

                                        <div class="order_card">
                                            <div class="status">{{ $order->status->name }}</div>
                                            <div class="card_header">
                                                <h5>{{ __('order number') }} <span>#{{ $order->id }}</span> </h5>
                                                <p> {{ __('order date') }}
                                                    <span>{{ $order->created_at->format('Y-m-d') }}</span>
                                                </p>
                                                <p>{{ __('Expected date of arrival of the order') }} <span>
                                                        {{ $order->created_at->addDays($app->expected_order_delivered) }}
                                                    </span> </p>
                                            </div>

                                            <hr>

                                            <div class="card_options mb-4">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <i class="fas fas fas fa-map-marker-alt"></i>
                                                        <span>{{ __('Order delivery address') }}</span>
                                                    </li>
                                                    <li>
                                                        <span>
                                                            {{ $order->address }}
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="card_footer">
                                                <div class="">

                                                    @if (in_array($order->order_status_id, [1, 2, 3]))
                                                        <a href="#" class="cancle-order-btn" data-bs-toggle="modal"
                                                            data-bs-target="#modaAddAdress" data-id="{{ $order->id }}">
                                                            {{ __('Cancelling order') }}
                                                        </a>
                                                    @endif


                                                </div>


                                                <div class="price">{{ $order->total }} ر.س</div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="order_details_book">
                                        @foreach ($order->items as $item)
                                            <div class="order_details_book_card d-flex align-items-start">
                                                <div class="card-img">
                                                    <div class="number">{{ $item->qty }}</div>
                                                    <div class="img-parent">
                                                        <img src="{{ asset($item->book->image) }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="card_body ms-3 mt-2">
                                                    <h5>{{ $item->book->name }}</h5>
                                                    @if (hasOffer($item->book->id))
                                                        <span class="price"> {{ $item->book->offer }} <span
                                                                class="text-decoration-line-through">{{ $item->book->price }}</span><span>
                                                                {{ __('sar') }}</span></span>
                                                    @else
                                                        <span class="price"> {{ $item->book->price }} <span>
                                                                {{ __('sar') }}</span></span>
                                                    @endif
                                                    <a href="#" class="btn btn-primary review-btn"
                                                        data-id="{{ $item->id }}"
                                                        data-star="{{ $item->review->star ?? null }}"
                                                        data-comment="{{ $item->review->comment ?? null }}"
                                                        data-bs-toggle="modal" data-bs-target="#reviewModal">
                                                        {{ __('Book evaluation') }}
                                                    </a>
                                                </div>
                                            </div>
                                            <hr>
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


    <div class="adress_modal">
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
                            <h5>{{ __('Cancle Order') }}</h5>
                        </div>
                        <div class=" col-lg-6 mx-auto">
                            <div class="">
                                <form action="{{ route('orders.cancle') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="order_id" id="OrderIdInput">
                                    <div class="options mt-5">
                                        <button type="submit"
                                            class="mx-1 btn btn-primary confirm-add-to-cart">{{ __("confirm") }}</button>
                                        <button data-bs-dismiss="modal" class="btn btn-secondary mx-1"
                                            href="">{{ __("Cancle") }}</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade moda_map" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">

                        <div class="close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times-circle"></i>
                        </div>

                        <div class="section_header text-center">
                            <h5>{{ __('Review Order') }}</h5>
                        </div>
                        <div class=" col-lg-6 mx-auto">
                            <div class="">
                                <form action="{{ route('site.books.review') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_item_id" id="ItemIdInput">
                                    <div class="form-group">
                                        <label for="starInput">{{ __("Stars") }}</label>
                                        <input type="number" min="0" max="5" name="star"
                                            placeholder="3.5" id="starInput" class="form-control">
                                    </div>

                                    <div class="form-group my-3">
                                        <label for="commentInput">{{ __("Comment") }}</label>
                                        <textarea name="comment" placeholder="{{ __("you opinion") }}" id="commentInput" class="form-control">{{ old('comment') }}</textarea>
                                    </div>

                                    <div class="options mt-5">
                                        <button type="submit"
                                            class="mx-1 btn btn-primary confirm-add-to-cart">{{ __("confirm") }}</button>
                                        <button data-bs-dismiss="modal" class="btn btn-secondary mx-1"
                                            href="">{{ __("Cancle") }}</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('input[name="lang"]');
            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    document.getElementById('langForm').submit();
                });
            });
        });
    </script>



    <script>
        $(document).on('click', '.cancle-order-btn', function() {
            let id = $(this).data('id');
            $('#OrderIdInput').val(id);
        });

        $(document).on('click', '.review-btn', function() {
            $('#ItemIdInput').val($(this).data('id'));
            $('#starInput').val($(this).data('star'));
            $('#commentInput').val($(this).data('comment'));
        });
    </script>
@endsection
