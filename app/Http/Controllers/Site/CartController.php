<?php

namespace App\Http\Controllers\Site;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\StoreCartRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Setting;
use App\Services\CartService;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }


    public function index(Request $request)
    {
        $cart = $request->user()->getOrCreateCart();

        return view('site.carts.index', compact('cart'));
    }

    public function store(StoreCartRequest $request)
    {
        $book = Book::findOrFail($request->id);
        $user = $request->user();

        $message = $this->cartService->addBookToCart($user, $book, $request->count);

        session()->flash("message", [
            'status' => true,
            'content' => $message
        ]);

        return redirect()->back();
    }

    public function destroy($item)
    {
        $item = CartItem::findOrFail($item);

        $item->delete();

        session()->flash("message", [
            'status' => true,
            'content' => __("deleted successfully")
        ]);

        return redirect()->back();
    }


    public function calcShipping(Request $request)
    {
        $app = Setting::first();

        if (!$app->use_shiping) {
            return response()->json([
                'status' => true,
                'shipping' => 0,
                'message' => ''
            ]);
        }

        if ($request->filled('lat') && $request->filled('lng')) {
            $freeDistance = $app->free_distance;
            $costPerKilo = $app->cost_per_km;
            $dontWorkThere = $app->non_operational_distance;

            $distance = distance($app->lat, $app->lng, $request->lat, $request->lng);

            if ($distance <= $freeDistance) {
                $shippingCost = 0;
                $status = true;
                $message = '';
            } elseif ($distance <= $dontWorkThere) {
                $shippingCost = 100;
                $status = true;
                $message = '';
            } else {
                $shippingCost = 0;
                $status = false;
                $message = 'We are not work there yet';
            }

            return response()->json([
                'status' => $status,
                'shipping' => ceil($shippingCost),
                'message' => $message
            ]);
        }

        return response()->json([
            'status' => false,
            'shipping' => 0,
            'message' => 'Latitude and longitude are required.'
        ], 400);
    }
}
