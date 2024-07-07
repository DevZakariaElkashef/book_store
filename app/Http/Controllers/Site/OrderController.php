<?php


namespace App\Http\Controllers\Site;

use App\Models\City;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\PaymentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CancleOrderRequest;
use App\Http\Requests\Site\PayOrderRequest;
use App\Http\Requests\Site\ReviewOrderRequest;

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

        foreach ($request->user()->cart->items as $item) {
            $item->delete();
        }

        $request->user()->cart->update(['coupon_id' => null]);

        return redirect()->route('orders.success');
    }


    public function callBack(Request $request)
    {
        $this->paymentService->getStatus($request);

        foreach ($request->user()->cart->items as $item) {
            $item->delete();
        }

        $request->user()->cart->update(['coupon_id' => null]);

        return redirect()->route('orders.success');
    }


    public function cancle(CancleOrderRequest $request)
    {
        $order = Order::findOrFail($request->order_id);
        $user = $request->user();

        if (!in_array($order->order_status_id, [1, 2, 3])) {
            session()->flash("message", [
                'status' => false,
                'content' => __('you can\'t cancle the order now')
            ]);

            return redirect()->back();
        }


        $order->update([
            'client_want_to_cancle' => 1,
        ]);


        session()->flash("message", [
            'status' => true,
            'content' => __('admin will proccess the cancle')
        ]);

        return redirect()->back();
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
