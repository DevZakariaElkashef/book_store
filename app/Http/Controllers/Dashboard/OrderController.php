<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Bank;
use App\Models\Book;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Exports\OrderExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OrderUpdateService;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    protected $orderUpdateService;

    public function __construct(OrderUpdateService $orderUpdateService)
    {
        $this->orderUpdateService = $orderUpdateService;
    }
    public function index(Request $request)
    {
        $ordersQuery = Order::query();
        $ordersQuery->latest();

        if ($request->filled('from')) {
            $ordersQuery->whereDate('created_at', '>', $request->from);
        }

        if ($request->filled('to')) {
            $ordersQuery->whereDate('created_at', '<', $request->to);
        }

        if ($request->filled('status') && $request->status == 'pending-cancle') {
            $ordersQuery->pendingCancellation();
        }


        if ($request->filled('type')) {
            $ordersQuery->where("order_status_id", $request->type);
        }



        $pendingCancleOrdersIds = Order::pendingCancellation()->pluck('id')->toArray();
        $clone = $ordersQuery->clone();

        foreach ($clone->whereNotIn('id', $pendingCancleOrdersIds)->where('is_new', 1)->get() as $order) {
            $order->update(['is_new' => 0]);
        }

        $orders = $ordersQuery->paginate(10);




        $orderStatus = OrderStatus::all();



        return view('dashboard.pages.orders.index', compact('orders', 'orderStatus'));
    }


    public function search(Request $request)
    {
        $query = Order::query();

        if ($request->has('val')) {
            $query->whereHas('user', function ($user) use ($request) {
                $user->where('name', 'like', "%{$request->val}%")
                    ->orWhere("email", "like", "%{$request->val}%")
                    ->orWhere("phone", "like", "%{$request->val}%");
            })->orWhere('sub_total', 'like', "%{$request->val}%")
                ->orWhere("total", "like", "%{$request->val}%")
                ->orWhere("id", "like", "%{$request->val}%")
                ->orWhere("transaction_id", "like", "%{$request->val}%")
                ->orWhere("address", "like", "%{$request->val}%")
                ->orWhere("note", "like", "%{$request->val}%")
                ->orWhere("lat", "like", "%{$request->val}%")
                ->orWhere("lng", "like", "%{$request->val}%");
        }

        $orders = $query->paginate(10);

        return view('dashboard.pages.orders.table', compact('orders'))->render();
    }



    public function export()
    {
        return Excel::download(new OrderExport, 'orders.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::active()->get();
        $cities = City::active()->get();
        $bank = Bank::first();
        $books = Book::active()->get();

        return view('dashboard.pages.orders.create', compact('users', 'cities', 'bank', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {

        Order::create($request->all());

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('created successfully')
        ];

        return to_route('orders.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        $orderStatuses = OrderStatus::all();
        $users = User::active()->get();
        $books = Book::active()->get();

        return view('dashboard.pages.orders.show', compact('order', 'orderStatuses', 'users', 'books'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return to_route('orders.show', $id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        $data = $request->all();

        $this->orderUpdateService->updateOrder($order, $data);

        // Return with toaster message
        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('orders.show', $order->id)->with('message', $message);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Order::where('id', $id)->delete();

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];

        return to_route('orders.index')->with('message', $message);
    }


    public function delete(Request $request)
    {
        if (!$request->filled('ids')) {
            $message = [
                'status' => false,
                'content' => __('select some items')
            ];

            return back()->with('message', $message);
        }


        $ids = explode(',', $request->ids);
        Order::whereIn('id', $ids)->delete();
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];
        return back()->with('message', $message);
    }
}
