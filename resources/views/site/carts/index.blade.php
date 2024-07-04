@extends('site.layout.app')

@php
    $totalCart = optional(auth()->user()->cart)->totalCart(auth()->id());
    $taxCost = $totalCart * ($app->tax / 100);
@endphp

@section('content')
    <div class="custom_preadcrumb">
        <div class="container-fluid pd-50">
            <ul class="mt-5 list-unstyled d-flex align-items-center">
                <li><a href="{{ route('site.home') }}">{{ __("Home") }}</a></li>
                <li><a href="{{ route('carts.index') }}">{{ __('Cart') }}</a></li>
            </ul>
        </div>
    </div>



    <div class="cart_page">
        <div class="container-fluid pd-50">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="cart_page_info">
                        @foreach ($cart->items as $item)
                            <div class="product_card_wide d-flex">
                                <div class="add_to_card">
                                    <a href="#" onclick="$('#deleteItemForm{{ $item->id }}').submit()">
                                        <img src="{{ asset('site/assets/images/delete.svg') }}" alt="">
                                    </a>
                                    <form id="deleteItemForm{{ $item->id }}" class="d-none"
                                        action="{{ route('carts.destroy', $item->id) }}" method="POST">
                                        @csrf
                                    </form>
                                </div>
                                <div class="card-img">
                                    <div class="img-parent">
                                        <img src="{{ asset($item->book->image) }}" alt="">
                                    </div>
                                </div>
                                <div class="card_body">
                                    <h5>{{ $item->book->name }}</h5>
                                    @if (in_array($item->book_id, \App\Models\Book::offers()->pluck('id')->toArray()))
                                        <span class="price">{{ $item->book->offer }} ر.س</span> <span class="discount">{{ $item->book->price }} ر.س</span>
                                    @else
                                        <span class="price">{{ $item->book->price }} ر.س</span>
                                    @endif
                                    <div class="buy_basket">
                                        <form id="cartForm{{ $item->book_id }}" action="{{ route('carts.store') }}"
                                            method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->book_id }}">
                                            <div class="form-group">
                                                <span class="custom-increment" style="cursor: pointer;"
                                                    data-id="{{ $item->book_id }}">+</span>
                                                <input type="number" class="form-control numinput"
                                                    id="num{{ $item->book_id }}" value="{{ $item->qty }}"
                                                    min="0" name="count">
                                                <span class="custom-decrement" style="cursor: pointer;"
                                                    data-id="{{ $item->book_id }}">-</span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>

                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="buy_basket">
                        <div class="card_header">
                            <h5>{{ __("shopping basket") }}</h5>
                        </div>
                        <form action="{{ route('coupons.check') }}" method="post">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-8 ">
                                    <input type="text" class="coupon form-control ms-2" name="code" value="{{ $cart->coupon->code ?? '' }}">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">{{ __("Add Coupon") }}</button>
                                </div>
                            </div>
                        </form>
                        <div class="card_info">
                            <ul class="list-unstyled">

                                <li>
                                    <span> {{ __("Number of products") }}</span>
                                    <div class="price d-flex align-items-center">
                                        <span>
                                            @if (auth()->user() && auth()->user()->cart && auth()->user()->cart->items->count())
                                                {{ auth()->user()->cart->items->count() }}
                                            @else
                                                0
                                            @endif
                                        </span>
                                    </div>
                                </li>

                                <li>
                                    <span> {{ __("Cost of products") }}</span>
                                    <div class="price d-flex align-items-center">
                                        <span>{{ $totalCart }}

                                            ر.س</span>
                                    </div>
                                </li>

                                @if ($taxCost)
                                    <li class="tax">
                                        <span> {{ __("Tax") }}</span>
                                        <div class="price d-flex align-items-center">
                                            <span>
                                                {{ $taxCost }} ر.س
                                            </span>
                                        </div>
                                    </li>
                                @endif


                                @if ($cart->coupon)
                                    <li class="discount">
                                        <span> {{ __("Discount") }}</span>
                                        <div class="price d-flex align-items-center">
                                            <span>
                                                {{ ($totalCart + $taxCost) * ($cart->coupon->discount / 100) }} ر.س
                                            </span>
                                        </div>
                                    </li>
                                @endif





                                <li>
                                    <span> {{ __("Total") }}</span>
                                    <div class="price d-flex align-items-center">
                                        <span>
                                            @if ($cart->coupon)
                                                {{ ($totalCart + $taxCost) - ($totalCart + $taxCost) * ($cart->coupon->discount / 100) }}
                                            @else
                                                {{ ($totalCart + $taxCost) }}
                                            @endif
                                            ر.س
                                        </span>
                                    </div>
                                </li>

                            </ul>

                            @if ($cart->items->count())
                                <div class="byu_btn">
                                    <a href="{{ route('orders.checkout') }}">{{ __("Complete the order") }}</a>
                                </div>
                            @endif
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
            document.querySelectorAll('.custom-increment').forEach(function(incrementButton) {
                incrementButton.addEventListener('click', function() {
                    let bookId = this.getAttribute('data-id');
                    let inputField = document.getElementById(`num${bookId}`);
                    inputField.value = parseInt(inputField.value) + 1;
                    document.getElementById(`cartForm${bookId}`).submit();
                });
            });

            document.querySelectorAll('.custom-decrement').forEach(function(decrementButton) {
                decrementButton.addEventListener('click', function() {
                    let bookId = this.getAttribute('data-id');
                    let inputField = document.getElementById(`num${bookId}`);
                    if (parseInt(inputField.value) > 0) {
                        inputField.value = parseInt(inputField.value) - 1;
                        document.getElementById(`cartForm${bookId}`).submit();
                    }
                });
            });
        });
    </script>
@endsection
