<?php


namespace App\Http\Controllers\Site;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\PayOrderRequest;
use App\Services\OrderService;
use App\Services\PaymentService;

class OrderController extends Controller
{
    protected $orderService;
    protected $paymentService;

    public function __construct(OrderService $orderService, PaymentService $paymentService)
    {
        $this->orderService = $orderService;
        $this->paymentService = $paymentService;
    }

    public function index(Request $request)
    {
        $cart = $request->user()->cart;

        if (!$cart->items->count()) {
            session()->flash("message", [
                'status' => false,
                'content' => __('add some items first')
            ]);
            return redirect()->route('site.home');
        }

        $cities = City::active()->get();

        return view('site.orders.index', compact('cart', 'cities'));
    }

    public function store(PayOrderRequest $request)
    {
        $user = $request->user();

        $user->update([
            'address' => $request->address,
            'city_id' => $request->city_id,
        ]);

        $orderData = $this->orderService->createOrder($user, $request->banktype, $request);

        if (!$request->banktype) {
            $paymentResponse = $this->paymentService->processPayment($user, $orderData['order'], $orderData['total']);
            return redirect()->away($paymentResponse);
        }

        return redirect()->route('order.success');
    }


    public function success()
    {
        session()->flash("message", [
            'status' => true,
            'content' => __('order completed')
        ]);

        return to_route('site.home');
    }

    public function error()
    {
        session()->flash("message", [
            'status' => false,
            'content' => __('order did not completed')
        ]);

        return to_route('site.home');
    }
}
