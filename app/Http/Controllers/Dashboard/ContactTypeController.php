<?php

namespace App\Http\Controllers\Dashboard;

use Log;
use App\Models\ContactType;
use Illuminate\Http\Request;
use App\Exports\ContactTypesExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Dashboard\StoreContactTypeRequest;

class ContactTypeController extends Controller
{

    public function __construct()
    {
        // $this->authorizeResource(ContactType::class, 'contact_type');
    }

    public function index(Request $request)
    {
        $this->authorize('contact_types.read');

        $contacttypesQuery = ContactType::query();
        $contacttypesQuery->latest();

        // Clone the query to calculate counts without date range filtering
        $countQuery = clone $contacttypesQuery;

        if ($request->filled('from')) {
            $contacttypesQuery->whereDate('created_at', '>', $request->from);
        }

        if ($request->filled('to')) {
            $contacttypesQuery->whereDate('created_at', '<', $request->to);
        }

        $contacttypes = $contacttypesQuery->paginate(10);

        // Get counts without date range filtering
        $totalContactTypesCount = $countQuery->count();
        $totalThisMonth = $countQuery->whereMonth('created_at', '=', date('m'))->count();
        $thisMonthPercentage = $totalContactTypesCount ? ceil(($totalThisMonth / $totalContactTypesCount) * 100) : 0;

        // Get counts with date range filtering
        $totalActiveContactTypesCount = $contacttypesQuery->count();
        $totalActiveThisMonth = $contacttypesQuery->whereMonth('created_at', '=', date('m'))->count();
        $thisActiveMonthPercentage = $totalActiveContactTypesCount ? ceil(($totalActiveThisMonth / $totalActiveContactTypesCount) * 100) : 0;

        $totalNotActiveContactTypesCount = $totalContactTypesCount - $totalActiveContactTypesCount;
        $totalNotActiveThisMonth = $totalThisMonth - $totalActiveThisMonth;
        $thisNotActiveMonthPercentage = $totalNotActiveContactTypesCount ? ceil(($totalNotActiveThisMonth / $totalNotActiveContactTypesCount) * 100) : 0;


        return view('dashboard.pages.contacttypes.index', compact('contacttypes', 'totalContactTypesCount', 'thisMonthPercentage', 'totalActiveContactTypesCount', 'thisActiveMonthPercentage', 'totalNotActiveContactTypesCount', 'thisNotActiveMonthPercentage'));
    }

    public function search(Request $request)
    {
        $this->authorize('contact_types.read');

        $query = ContactType::query();

        if ($request->has('val')) {
            $query->where(function ($q) use ($request) {
                $q->where('name_ar', 'like', '%' . $request->val . '%')
                    ->orWhere('name_en', 'like', '%' . $request->val . '%');
            });
        }

        $contacttypes = $query->paginate(10);

        return view('dashboard.pages.contacttypes.table', compact('contacttypes'))->render();
    }



    public function export()
    {
        $this->authorize('contact_types.read');

        return Excel::download(new ContactTypesExport, 'contacttypes.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('contact_types.create');
        return view('dashboard.pages.contacttypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactTypeRequest $request)
    {
        $this->authorize('contact_types.create');

        ContactType::create($request->all());

        $message = [
            'status' => true,
            'content' => __('created successfully')
        ];

        return to_route('contact_types.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('contact_types.read');

        return to_route('contact_types.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('contact_types.update');
        $contacttype = ContactType::findOrFail($id);
        return view('dashboard.pages.contacttypes.edit', compact('contacttype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreContactTypeRequest $request, string $id)
    {
        $this->authorize('contact_types.update');

        $contacttype = ContactType::findOrFail($id);

        $contacttype->update($request->all());

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('contact_types.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('contact_types.delete');

        ContactType::where('id', $id)->delete();

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];

        return to_route('contact_types.index')->with('message', $message);
    }

    public function delete(Request $request)
    {
        $this->authorize('contact_types.delete');

        if (!$request->filled('ids')) {
            $message = [
                'status' => false,
                'content' => __('select some items')
            ];

            return back()->with('message', $message);
        }


        $ids = explode(',', $request->ids);
        ContactType::whereIn('id', $ids)->delete();
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];
        return back()->with('message', $message);
    }
}
