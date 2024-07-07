<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Exports\CouponsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Dashboard\StoreCouponRequest;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $couponsQuery = Coupon::query();
        $couponsQuery->latest();

        // Clone the query to calculate counts without date range filtering
        $countQuery = clone $couponsQuery;

        if ($request->filled('from')) {
            $couponsQuery->whereDate('created_at', '>', $request->from);
        }

        if ($request->filled('to')) {
            $couponsQuery->whereDate('created_at', '<', $request->to);
        }

        $coupons = $couponsQuery->paginate(10);

        // Get counts without date range filtering
        $totalCouponsCount = $countQuery->count();
        $totalThisMonth = $countQuery->whereMonth('created_at', '=', date('m'))->count();
        $thisMonthPercentage = $totalCouponsCount ? ceil(($totalThisMonth / $totalCouponsCount) * 100) : 0;

        // Get counts with date range filtering
        $totalActiveCouponsCount = $couponsQuery->where('is_active', 1)->count();
        $totalActiveThisMonth = $couponsQuery->where('is_active', 1)->whereMonth('created_at', '=', date('m'))->count();
        $thisActiveMonthPercentage = $totalActiveCouponsCount ? ceil(($totalActiveThisMonth / $totalActiveCouponsCount) * 100) : 0;

        $totalNotActiveCouponsCount = $totalCouponsCount - $totalActiveCouponsCount;
        $totalNotActiveThisMonth = $totalThisMonth - $totalActiveThisMonth;
        $thisNotActiveMonthPercentage = $totalNotActiveCouponsCount ? ceil(($totalNotActiveThisMonth / $totalNotActiveCouponsCount) * 100) : 0;

        return view('dashboard.pages.coupons.index', compact('coupons', 'totalCouponsCount', 'thisMonthPercentage', 'totalActiveCouponsCount', 'thisActiveMonthPercentage', 'totalNotActiveCouponsCount', 'thisNotActiveMonthPercentage'));
    }


    public function search(Request $request)
    {
        $query = Coupon::query();

        if ($request->has('val')) {
            $query->where(function ($q) use ($request) {
                $q->where('code', 'like', '%' . $request->val . '%')
                    ->orWhere('discount', 'like', '%' . $request->val . '%')
                    ->orWhere('start_at', 'like', '%' . $request->val . '%')
                    ->orWhere('end_at', 'like', '%' . $request->val . '%')
                    ->orWhere('max_times', 'like', '%' . $request->val . '%');
            });
        }

        $coupons = $query->paginate(10);

        return view('dashboard.pages.coupons.table', compact('coupons'))->render();
    }



    public function export()
    {
        return Excel::download(new CouponsExport, 'coupons.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCouponRequest $request)
    {

        Coupon::create($request->all());

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('created successfully')
        ];

        return to_route('coupons.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return to_route('coupons.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::findOrFail($id);

        return view('dashboard.pages.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCouponRequest $request, string $id)
    {
        $coupon = Coupon::findOrFail($id);

        $data = $request->all();

        $coupon->update($data);

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('coupons.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Coupon::where('id', $id)->delete();

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];

        return to_route('coupons.index')->with('message', $message);
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
        Coupon::whereIn('id', $ids)->delete();
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];
        return back()->with('message', $message);
    }
}
