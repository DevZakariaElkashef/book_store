<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\University;
use Illuminate\Http\Request;
use App\Exports\UniversitiesExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Dashboard\StoreUniversityRequest;

class UniversityController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('universities.read');

        $universitiesQuery = University::query();
        $universitiesQuery->latest();

        // Clone the query to calculate counts without date range filtering
        $countQuery = clone $universitiesQuery;

        if ($request->filled('from')) {
            $universitiesQuery->whereDate('created_at', '>', $request->from);
        }

        if ($request->filled('to')) {
            $universitiesQuery->whereDate('created_at', '<', $request->to);
        }

        $universities = $universitiesQuery->paginate(10);

        // Get counts without date range filtering
        $totalUniversitiesCount = $countQuery->count();
        $totalThisMonth = $countQuery->whereMonth('created_at', '=', date('m'))->count();
        $thisMonthPercentage = $totalUniversitiesCount ? ceil(($totalThisMonth / $totalUniversitiesCount) * 100) : 0;

        // Get counts with date range filtering
        $totalActiveUniversitiesCount = $universitiesQuery->where('is_active', 1)->count();
        $totalActiveThisMonth = $universitiesQuery->where('is_active', 1)->whereMonth('created_at', '=', date('m'))->count();
        $thisActiveMonthPercentage = $totalActiveUniversitiesCount ? ceil(($totalActiveThisMonth / $totalActiveUniversitiesCount) * 100) : 0;

        $totalNotActiveUniversitiesCount = $totalUniversitiesCount - $totalActiveUniversitiesCount;
        $totalNotActiveThisMonth = $totalThisMonth - $totalActiveThisMonth;
        $thisNotActiveMonthPercentage = $totalNotActiveUniversitiesCount ? ceil(($totalNotActiveThisMonth / $totalNotActiveUniversitiesCount) * 100) : 0;

        return view('dashboard.pages.universities.index', compact('universities', 'totalUniversitiesCount', 'thisMonthPercentage', 'totalActiveUniversitiesCount', 'thisActiveMonthPercentage', 'totalNotActiveUniversitiesCount', 'thisNotActiveMonthPercentage'));
    }


    public function search(Request $request)
    {
        $this->authorize('universities.read');

        $query = University::query();

        if ($request->has('val')) {
            $query->where(function ($q) use ($request) {
                $q->where('name_ar', 'like', '%' . $request->val . '%')
                    ->orWhere('name_en', 'like', '%' . $request->val . '%')
                    ->orWhere('description_ar', 'like', '%' . $request->val . '%')
                    ->orWhere('description_en', 'like', '%' . $request->val . '%');
            });
        }

        $universities = $query->paginate(10);

        return view('dashboard.pages.universities.table', compact('universities'))->render();
    }



    public function export()
    {
        $this->authorize('universities.read');

        return Excel::download(new UniversitiesExport, 'universities.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('universities.create');

        return view('dashboard.pages.universities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUniversityRequest $request)
    {
        $this->authorize('universities.create');

        $data = $request->except('image');

        if ($request->has('image')) {

            $data['image'] = uploadeImage($request->image, "Universities");
        }

        University::create($data);

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('created successfully')
        ];

        return to_route('universities.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return to_route('universities.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('universities.update');

        $university = University::findOrFail($id);

        return view('dashboard.pages.universities.edit', compact('university'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUniversityRequest $request, string $id)
    {

        $this->authorize('universities.update');

        $university = University::findOrFail($id);

        $data = $request->except('image');

        if ($request->has('image')) {

            $data['image'] = uploadeImage($request->image, "Universities", $university->image);
        }

        $university->update($data);

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('universities.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('universities.delete');

        University::where('id', $id)->delete();

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];

        return to_route('universities.index')->with('message', $message);
    }

    public function delete(Request $request)
    {
        $this->authorize('universities.delete');

        if (!$request->filled('ids')) {
            $message = [
                'status' => false,
                'content' => __('select some items')
            ];

            return back()->with('message', $message);
        }


        $ids = explode(',', $request->ids);
        University::whereIn('id', $ids)->delete();
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];
        return back()->with('message', $message);
    }
}
