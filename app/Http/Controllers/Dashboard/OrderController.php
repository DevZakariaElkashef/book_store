<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use App\Exports\OrderExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Bank;
use App\Models\Book;
use App\Models\City;
use App\Models\User;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $ordersQuery = Order::query();
        $ordersQuery->latest();

        // Clone the query to calculate counts without date range filtering
        $countQuery = clone $ordersQuery;

        if ($request->filled('from')) {
            $ordersQuery->whereDate('created_at', '>', $request->from);
        }

        if ($request->filled('to')) {
            $ordersQuery->whereDate('created_at', '<', $request->to);
        }

        $orders = $ordersQuery->paginate(10);

        // Get counts without date range filtering
        $totalOrdersCount = $countQuery->count();
        $totalThisMonth = $countQuery->whereMonth('created_at', '=', date('m'))->count();
        $thisMonthPercentage = $totalOrdersCount ? ceil(($totalThisMonth / $totalOrdersCount) * 100) : 0;

        // Get counts with date range filtering
        $totalActiveOrdersCount = $ordersQuery->where('is_active', 1)->count();
        $totalActiveThisMonth = $ordersQuery->where('is_active', 1)->whereMonth('created_at', '=', date('m'))->count();
        $thisActiveMonthPercentage = $totalActiveOrdersCount ? ceil(($totalActiveThisMonth / $totalActiveOrdersCount) * 100) : 0;

        $totalNotActiveOrdersCount = $totalOrdersCount - $totalActiveOrdersCount;
        $totalNotActiveThisMonth = $totalThisMonth - $totalActiveThisMonth;
        $thisNotActiveMonthPercentage = $totalNotActiveOrdersCount ? ceil(($totalNotActiveThisMonth / $totalNotActiveOrdersCount) * 100) : 0;

        return view('dashboard.pages.orders.index', compact('orders', 'totalOrdersCount', 'thisMonthPercentage', 'totalActiveOrdersCount', 'thisActiveMonthPercentage', 'totalNotActiveOrdersCount', 'thisNotActiveMonthPercentage'));
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

        return view('dashboard.pages.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);

        return view('dashboard.pages.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOrderRequest $request, string $id)
    {
        $order = Order::findOrFail($id);

        $data = $request->all();

        $order->update($data);

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('orders.index')->with('message', $message);
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
