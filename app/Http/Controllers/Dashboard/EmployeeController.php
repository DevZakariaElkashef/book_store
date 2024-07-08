<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\EmployeeExport;
use App\Models\Employee;
use App\Exports\EmployeesExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Dashboard\StoreEmployeeRequest;
use App\Http\Requests\Dashboard\UpdateEmployeeReqeust;
use App\Models\City;
use App\Models\User;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employeesQuery = User::query();

        $employeesQuery->latest()->where('id', '!=', auth()->user()->id);

        // Clone the query to calculate counts without date range filtering
        $countQuery = clone $employeesQuery;

        if ($request->filled('from')) {
            $employeesQuery->whereDate('created_at', '>', $request->from);
        }

        if ($request->filled('to')) {
            $employeesQuery->whereDate('created_at', '<', $request->to);
        }

        // Join with roles table to exclude users with the 'client' role
        $employeesQuery->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'client');
        });

        $employees = $employeesQuery->paginate(10);

        // Get counts without date range filtering
        $totalEmployeesCount = $countQuery->count();
        $totalThisMonth = $countQuery->whereMonth('created_at', '=', date('m'))->count();
        $thisMonthPercentage = $totalEmployeesCount ? ceil(($totalThisMonth / $totalEmployeesCount) * 100) : 0;

        // Get counts with date range filtering
        $totalActiveEmployeesCount = $employeesQuery->where('is_active', 1)->count();
        $totalActiveThisMonth = $employeesQuery->where('is_active', 1)->whereMonth('created_at', '=', date('m'))->count();
        $thisActiveMonthPercentage = $totalActiveEmployeesCount ? ceil(($totalActiveThisMonth / $totalActiveEmployeesCount) * 100) : 0;

        $totalNotActiveEmployeesCount = $totalEmployeesCount - $totalActiveEmployeesCount;
        $totalNotActiveThisMonth = $totalThisMonth - $totalActiveThisMonth;
        $thisNotActiveMonthPercentage = $totalNotActiveEmployeesCount ? ceil(($totalNotActiveThisMonth / $totalNotActiveEmployeesCount) * 100) : 0;

        return view('dashboard.pages.employees.index', compact('employees', 'totalEmployeesCount', 'thisMonthPercentage', 'totalActiveEmployeesCount', 'thisActiveMonthPercentage', 'totalNotActiveEmployeesCount', 'thisNotActiveMonthPercentage'));
    }





    public function search(Request $request)
    {
        $query = User::query();

        if ($request->has('val')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->val . '%')
                    ->orWhere('email', 'like', '%' . $request->val . '%')
                    ->orWhere('phone', 'like', '%' . $request->val . '%');
            })->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'client');
            });
        }

        $employees = $query->where('id', '!=', auth()->user()->id)->paginate(10);

        return view('dashboard.pages.employees.table', compact('employees'))->render();
    }



    public function export()
    {
        return Excel::download(new EmployeeExport, 'employees.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::active()->get();
        $roles = Role::where("name", '!=', 'client')->get();

        return view('dashboard.pages.employees.create', compact('cities', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $data = $request->except('avatar');

        if ($request->has('avatar')) {

            $data['avatar'] = uploadeImage($request->avatar, "Employees");
        }

        $user = User::create($data);
        $user->syncRoles(Role::find($request->role_id)->first());

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('created successfully')
        ];

        return to_route('employees.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return to_route('employees.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = User::findOrFail($id);
        $cities = City::active()->get();
        $roles = Role::where("name", '!=', 'client')->get();

        abort_if(auth()->user()->id == $id, 404);

        return view('dashboard.pages.employees.edit', compact('employee', 'cities', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEmployeeRequest $request, string $id)
    {
        $employee = User::findOrFail($id);

        $data = $request->except('avatar');

        if ($request->has('avatar')) {

            $data['avatar'] = uploadeImage($request->avatar, "Employees");
        }

        $employee->update($data);

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('employees.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];

        return to_route('employees.index')->with('message', $message);
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
        User::whereIn('id', $ids)->delete();
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];
        return back()->with('message', $message);
    }
}
