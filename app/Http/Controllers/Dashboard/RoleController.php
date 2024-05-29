<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleReqeust;
use Spatie\Permission\Models\Permission;
use App\Notifications\RoleActivityNotifications;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with(['users', 'permissions'])->get();
        $permissions = DB::table('permissions')
            ->select(DB::raw("SUBSTRING_INDEX(name, '.', 1) as prefix"), 'id', DB::raw("SUBSTRING_INDEX(name, '.', -1) as name"))
            ->orderBy('prefix')
            ->get()
            ->groupBy('prefix');

        return view('dashboard.pages.roles.list', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        // find the role if not exist create it and attac the permissions to that role
        Role::firstOrCreate(['name' => Str::lower($request->name)])->syncPermissions(Permission::find($request->permissions));

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('Role created successfully')
        ];

        return back()->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleReqeust $request, string $id)
    {
        $role = Role::findOrFail($id);
        $role->syncPermissions(Permission::find($request->permissions));

        // retun with toaster messate
        $message = [
            'status' => true,
            'content' => __('Role updated successfully')
        ];

        return back()->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        $message = [
            'status' => true,
            'content' => __('Role deleted successfully')
        ];

        return back()->with('message', $message);
    }
}
