<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use Illuminate\Http\Request;
use App\Exports\CitiesExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Dashboard\StoreCityRequest;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $citiesQuery = City::query();
        $citiesQuery->latest();

        // Clone the query to calculate counts without date range filtering
        $countQuery = clone $citiesQuery;

        if ($request->filled('from')) {
            $citiesQuery->whereDate('created_at', '>', $request->from);
        }

        if ($request->filled('to')) {
            $citiesQuery->whereDate('created_at', '<', $request->to);
        }

        $cities = $citiesQuery->paginate(10);

        // Get counts without date range filtering
        $totalCitiesCount = $countQuery->count();
        $totalThisMonth = $countQuery->whereMonth('created_at', '=', date('m'))->count();
        $thisMonthPercentage = $totalCitiesCount ? ceil(($totalThisMonth / $totalCitiesCount) * 100) : 0;

        // Get counts with date range filtering
        $totalActiveCitiesCount = $citiesQuery->where('is_active', 1)->count();
        $totalActiveThisMonth = $citiesQuery->where('is_active', 1)->whereMonth('created_at', '=', date('m'))->count();
        $thisActiveMonthPercentage = $totalActiveCitiesCount ? ceil(($totalActiveThisMonth / $totalActiveCitiesCount) * 100) : 0;

        $totalNotActiveCitiesCount = $totalCitiesCount - $totalActiveCitiesCount;
        $totalNotActiveThisMonth = $totalThisMonth - $totalActiveThisMonth;
        $thisNotActiveMonthPercentage = $totalNotActiveCitiesCount ? ceil(($totalNotActiveThisMonth / $totalNotActiveCitiesCount) * 100) : 0;

        return view('dashboard.pages.cities.index', compact('cities', 'totalCitiesCount', 'thisMonthPercentage', 'totalActiveCitiesCount', 'thisActiveMonthPercentage', 'totalNotActiveCitiesCount', 'thisNotActiveMonthPercentage'));
    }


    public function search(Request $request)
    {
        $query = City::query();

        if ($request->has('val')) {
            $query->where(function ($q) use ($request) {
                $q->where('name_ar', 'like', '%' . $request->val . '%')
                    ->orWhere('name_en', 'like', '%' . $request->val . '%');
            });
        }

        $cities = $query->paginate(10);

        return view('dashboard.pages.cities.table', compact('cities'))->render();
    }



    public function export()
    {
        return Excel::download(new CitiesExport, 'cities.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request)
    {

        City::create($request->all());

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('created successfully')
        ];

        return to_route('cities.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return to_route('cities.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city = City::findOrFail($id);

        return view('dashboard.pages.cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCityRequest $request, string $id)
    {
        $city = City::findOrFail($id);

        $data = $request->all();

        $city->update($data);

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('cities.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        City::where('id', $id)->delete();

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];

        return to_route('cities.index')->with('message', $message);
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
        City::whereIn('id', $ids)->delete();
        $message = [
           'status' => true,
            'content' => __('deleted successfully')
        ];
        return back()->with('message', $message);
    }
}
