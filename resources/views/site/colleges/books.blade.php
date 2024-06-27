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
                    <span class="price">{{ $book->price }} <span> ر.س</span></span>
                    <div class="options">
                        <a href="#" onclick="$('#addToCartForm{{ $book->id }}').submit()"
                            class="d-inline-flex align-items-center">
                            <form id="addToCartForm{{ $book->id }}" class="d-none"
                                action="{{ route('carts.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                            </form>
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span>إضافة للسلة</span>
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
