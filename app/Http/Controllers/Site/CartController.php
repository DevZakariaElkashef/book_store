<?php

namespace App\Http\Controllers\Site;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\StoreCartRequest;
use App\Models\Cart;
use App\Services\CartService;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }


    public function index()
    {
    }

    public function store(StoreCartRequest $request)
    {
        $book = Book::findOrFail($request->book_id);
        $user = $request->user();

        $message = $this->cartService->addBookToCart($user, $book);

        session()->flash("message", [
            'status' => true,
            'content' => $message
        ]);

        return redirect()->back();
    }
}
