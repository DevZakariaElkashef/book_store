<?php

namespace App\Http\Controllers\Dashbaord;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreUserRequest;
use App\Http\Requests\Dashboard\UpdateUserReqeust;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('dashboard.pages.users.index', compact('users'));
    }



    public function search(Request $request)
    {
        $users = User::where('name', 'like', '%' . $request->val . '%')
            ->orWhere('name', 'like', '%' . $request->val . '%')
            ->orWhere('email', 'like', '%' . $request->val . '%')
            ->orWhere('phone', 'like', '%' . $request->val . '%')
            ->paginate(10);
        return view('dashboard.pages.users.table', compact('users'))->render();
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
            'content' => __('User created successfully')
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
}
