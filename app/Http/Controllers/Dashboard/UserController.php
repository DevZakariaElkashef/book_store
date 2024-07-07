<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Dashboard\StoreUserRequest;
use App\Http\Requests\Dashboard\UpdateUserReqeust;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $usersQuery = User::query();
        $usersQuery->latest()->where('id', '!=', auth()->user()->id);

        // Clone the query to calculate counts without date range filtering
        $countQuery = clone $usersQuery;

        if ($request->filled('from')) {
            $usersQuery->whereDate('created_at', '>', $request->from);
        }

        if ($request->filled('to')) {
            $usersQuery->whereDate('created_at', '<', $request->to);
        }

        $users = $usersQuery->paginate(10);

        // Get counts without date range filtering
        $totalUsersCount = $countQuery->count();
        $totalThisMonth = $countQuery->whereMonth('created_at', '=', date('m'))->count();
        $thisMonthPercentage = $totalUsersCount ? ceil(($totalThisMonth / $totalUsersCount) * 100) : 0;

        // Get counts with date range filtering
        $totalActiveUsersCount = $usersQuery->where('is_active', 1)->count();
        $totalActiveThisMonth = $usersQuery->where('is_active', 1)->whereMonth('created_at', '=', date('m'))->count();
        $thisActiveMonthPercentage = $totalActiveUsersCount ? ceil(($totalActiveThisMonth / $totalActiveUsersCount) * 100) : 0;

        $totalNotActiveUsersCount = $totalUsersCount - $totalActiveUsersCount;
        $totalNotActiveThisMonth = $totalThisMonth - $totalActiveThisMonth;
        $thisNotActiveMonthPercentage = $totalNotActiveUsersCount ? ceil(($totalNotActiveThisMonth / $totalNotActiveUsersCount) * 100) : 0;

        return view('dashboard.pages.users.index', compact('users', 'totalUsersCount', 'thisMonthPercentage', 'totalActiveUsersCount', 'thisActiveMonthPercentage', 'totalNotActiveUsersCount', 'thisNotActiveMonthPercentage'));
    }





    public function search(Request $request)
    {
        $query = User::query();

        if ($request->has('val')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->val . '%')
                    ->orWhere('email', 'like', '%' . $request->val . '%')
                    ->orWhere('phone', 'like', '%' . $request->val . '%');
            });
        }

        $users = $query->where('id', '!=', auth()->user()->id)->paginate(10);

        return view('dashboard.pages.users.table', compact('users'))->render();
    }



    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->except('avatar', 'password');

        $data['password'] = Hash::make('password');


        if ($request->has('avatar')) {

            $data['avatar'] = uploadeImage($request->avatar, "Users");
        }

        User::create($data);

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('created successfully')
        ];

        return to_route('users.index')->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return to_route('users.edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        abort_if(auth()->user()->id == $id, 404);

        return view('dashboard.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserReqeust $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = $request->except('avatar', 'password');

        if ($request->has('avatar')) {

            $data['avatar'] = uploadeImage($request->avatar, "Users");
        }

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('users.index')->with('message', $message);
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

        return to_route('users.index')->with('message', $message);
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
