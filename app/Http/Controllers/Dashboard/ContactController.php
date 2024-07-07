<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Exports\ContactsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Dashboard\UpdateContactRequest;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Contact::class, 'Contact');
    }

    public function index(Request $request)
    {
        $contactsQuery = Contact::query();
        $contactsQuery->latest();

        // Clone the query to calculate counts without date range filtering
        $countQuery = clone $contactsQuery;

        if ($request->filled('from')) {
            $contactsQuery->whereDate('created_at', '>', $request->from);
        }

        if ($request->filled('to')) {
            $contactsQuery->whereDate('created_at', '<', $request->to);
        }

        $contacts = $contactsQuery->with('contactType')->paginate(10);

        // Get counts without date range filtering
        $totalContactsCount = $countQuery->count();
        $totalThisMonth = $countQuery->whereMonth('created_at', '=', date('m'))->count();
        $thisMonthPercentage = $totalContactsCount ? ceil(($totalThisMonth / $totalContactsCount) * 100) : 0;

        // Get counts with date range filtering
        $totalActiveContactsCount = $contactsQuery->count();
        $totalActiveThisMonth = $contactsQuery->whereMonth('created_at', '=', date('m'))->count();
        $thisActiveMonthPercentage = $totalActiveContactsCount ? ceil(($totalActiveThisMonth / $totalActiveContactsCount) * 100) : 0;

        $totalNotActiveContactsCount = $totalContactsCount - $totalActiveContactsCount;
        $totalNotActiveThisMonth = $totalThisMonth - $totalActiveThisMonth;
        $thisNotActiveMonthPercentage = $totalNotActiveContactsCount ? ceil(($totalNotActiveThisMonth / $totalNotActiveContactsCount) * 100) : 0;


        return view('dashboard.pages.contacts.index', compact('contacts', 'totalContactsCount', 'thisMonthPercentage', 'totalActiveContactsCount', 'thisActiveMonthPercentage', 'totalNotActiveContactsCount', 'thisNotActiveMonthPercentage'));
    }

    public function search(Request $request)
    {
        $query = Contact::query();

        if ($request->has('val')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->val . '%')
                    ->orWhere('email', 'like', '%' . $request->val . '%')
                    ->orWhere('message', 'like', '%' . $request->val . '%');
            });
        }

        $contacts = $query->paginate(10);

        return view('dashboard.pages.contacts.table', compact('contacts'))->render();
    }



    public function export()
    {
        return Excel::download(new ContactsExport, 'contacts.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return to_route('contacts.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('dashboard.pages.contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, string $id)
    {
        $contact = Contact::findOrFail($id);

        $contact->update($request->all());

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('contacts.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Contact::where('id', $id)->delete();

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];

        return to_route('contacts.index')->with('message', $message);
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
        Contact::whereIn('id', $ids)->delete();
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];
        return back()->with('message', $message);
    }
}
