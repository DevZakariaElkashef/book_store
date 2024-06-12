<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Subject;
use App\Models\University;
use Illuminate\Http\Request;
use App\Exports\SubjectsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\StoreSubjectRequest;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $subjectsQuery = Subject::query();
        $subjectsQuery->latest();

        // Clone the query to calculate counts without date range filtering
        $countQuery = clone $subjectsQuery;

        if ($request->filled('from')) {
            $subjectsQuery->whereDate('created_at', '>', $request->from);
        }

        if ($request->filled('to')) {
            $subjectsQuery->whereDate('created_at', '<', $request->to);
        }

        if ($request->filled('university_id')) {
            $subjectsQuery->where('university_id', $request->university_id);
        }

        $subjects = $subjectsQuery->paginate(10);

        // Get counts without date range filtering
        $totalSubjectsCount = $countQuery->count();
        $totalThisMonth = $countQuery->whereMonth('created_at', '=', date('m'))->count();
        $thisMonthPercentage = $totalSubjectsCount ? ceil(($totalThisMonth / $totalSubjectsCount) * 100) : 0;

        // Get counts with date range filtering
        $totalActiveSubjectsCount = $subjectsQuery->where('is_active', 1)->count();
        $totalActiveThisMonth = $subjectsQuery->where('is_active', 1)->whereMonth('created_at', '=', date('m'))->count();
        $thisActiveMonthPercentage = $totalActiveSubjectsCount ? ceil(($totalActiveThisMonth / $totalActiveSubjectsCount) * 100) : 0;

        $totalNotActiveSubjectsCount = $totalSubjectsCount - $totalActiveSubjectsCount;
        $totalNotActiveThisMonth = $totalThisMonth - $totalActiveThisMonth;
        $thisNotActiveMonthPercentage = $totalNotActiveSubjectsCount ? ceil(($totalNotActiveThisMonth / $totalNotActiveSubjectsCount) * 100) : 0;

        $universities = University::all();

        return view('dashboard.pages.subjects.index', compact('subjects', 'universities', 'totalSubjectsCount', 'thisMonthPercentage', 'totalActiveSubjectsCount', 'thisActiveMonthPercentage', 'totalNotActiveSubjectsCount', 'thisNotActiveMonthPercentage'));
    }


    public function getSubjectsByCollegeId(Request $request)
    {
        $subjects = Subject::active()->where('university_id', $request->univirsityId)->get();
        $oldSubject = $request->subjectId;


        return view('dashboard.partials.__subject_options', compact('subjects', 'oldSubject'))->render();
    }


    public function search(Request $request)
    {
        $query = Subject::query();

        if ($request->has('val')) {
            $query->where(function ($q) use ($request) {
                $q->where('name_ar', 'like', '%' . $request->val . '%')
                    ->orWhere('name_en', 'like', '%' . $request->val . '%');
            });
        }

        $subjects = $query->paginate(10);

        return view('dashboard.pages.subjects.table', compact('subjects'))->render();
    }



    public function export()
    {
        return Excel::download(new SubjectsExport, 'subjects.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $universities = University::all();
        return view('dashboard.pages.subjects.create', compact('universities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request)
    {

        Subject::create($request->all());

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('Subject created successfully')
        ];

        return to_route('subjects.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return to_route('subjects.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subject = Subject::findOrFail($id);
        $universities = University::all();

        return view('dashboard.pages.subjects.edit', compact('subject', 'universities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSubjectRequest $request, string $id)
    {
        $subject = Subject::findOrFail($id);


        $subject->update($request->all());

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('subjects.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Subject::where('id', $id)->delete();

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];

        return to_route('subjects.index')->with('message', $message);
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
        Subject::whereIn('id', $ids)->delete();
        $message = [
           'status' => true,
            'content' => __('deleted successfully')
        ];
        return back()->with('message', $message);
    }
}
