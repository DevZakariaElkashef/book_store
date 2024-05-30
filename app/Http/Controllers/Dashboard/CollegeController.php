<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\College;
use Illuminate\Http\Request;
use App\Exports\CollegesExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Dashboard\StoreCollegeRequest;
use App\Models\University;

class CollegeController extends Controller
{
    public function index(Request $request)
    {
        $collegesQuery = College::query();
        $collegesQuery->latest();

        // Clone the query to calculate counts without date range filtering
        $countQuery = clone $collegesQuery;

        if ($request->filled('from')) {
            $collegesQuery->whereDate('created_at', '>', $request->from);
        }

        if ($request->filled('to')) {
            $collegesQuery->whereDate('created_at', '<', $request->to);
        }

        if ($request->filled('university_id')) {
            $collegesQuery->where('university_id', $request->university_id);
        }

        $colleges = $collegesQuery->with('university')->paginate(10);

        // Get counts without date range filtering
        $totalCollegesCount = $countQuery->count();
        $totalThisMonth = $countQuery->whereMonth('created_at', '=', date('m'))->count();
        $thisMonthPercentage = $totalCollegesCount ? ceil(($totalThisMonth / $totalCollegesCount) * 100) : 0;

        // Get counts with date range filtering
        $totalActiveCollegesCount = $collegesQuery->where('is_active', 1)->count();
        $totalActiveThisMonth = $collegesQuery->where('is_active', 1)->whereMonth('created_at', '=', date('m'))->count();
        $thisActiveMonthPercentage = $totalActiveCollegesCount ? ceil(($totalActiveThisMonth / $totalActiveCollegesCount) * 100) : 0;

        $totalNotActiveCollegesCount = $totalCollegesCount - $totalActiveCollegesCount;
        $totalNotActiveThisMonth = $totalThisMonth - $totalActiveThisMonth;
        $thisNotActiveMonthPercentage = $totalNotActiveCollegesCount ? ceil(($totalNotActiveThisMonth / $totalNotActiveCollegesCount) * 100) : 0;

        $universities = University::all();

        return view('dashboard.pages.colleges.index', compact('colleges', 'universities', 'totalCollegesCount', 'thisMonthPercentage', 'totalActiveCollegesCount', 'thisActiveMonthPercentage', 'totalNotActiveCollegesCount', 'thisNotActiveMonthPercentage'));
    }


    public function search(Request $request)
    {
        $query = College::query();

        if ($request->has('val')) {
            $query->where(function ($q) use ($request) {
                $q->where('name_ar', 'like', '%' . $request->val . '%')
                    ->orWhere('name_en', 'like', '%' . $request->val . '%')
                    ->orWhere('description_ar', 'like', '%' . $request->val . '%')
                    ->orWhere('description_en', 'like', '%' . $request->val . '%');
            });
        }

        $colleges = $query->paginate(10);

        return view('dashboard.pages.colleges.table', compact('colleges'))->render();
    }



    public function export()
    {
        return Excel::download(new CollegesExport, 'colleges.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $universities = University::all();
        return view('dashboard.pages.colleges.create', compact('universities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCollegeRequest $request)
    {
        $data = $request->except('image');

        if ($request->has('image')) {

            $data['image'] = uploadeImage($request->image, "Colleges");
        }

        College::create($data);

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('College created successfully')
        ];

        return to_route('colleges.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return to_route('colleges.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $college = College::findOrFail($id);
        $universities = University::all();

        return view('dashboard.pages.colleges.edit', compact('college', 'universities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCollegeRequest $request, string $id)
    {
        $college = College::findOrFail($id);

        $data = $request->except('image');

        if ($request->has('image')) {

            $data['image'] = uploadeImage($request->image, "Colleges", $college->image);
        }

        $college->update($data);

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('colleges.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        College::where('id', $id)->delete();

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];

        return to_route('colleges.index')->with('message', $message);
    }
}
