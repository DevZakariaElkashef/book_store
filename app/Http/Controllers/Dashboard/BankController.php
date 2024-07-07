<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $this->authorize('settings.read');

        $bank = Bank::first();

        return view('dashboard.pages.settings.bank', compact('bank'));
    }

    public function update(Request $request, Bank $bank)
    {
        $this->authorize('settings.update');

        $bank->update($request->all());

        $message = [
            'status' => true,
            'content' => __('created successfully')
        ];
        return back()->with('message', $message);
    }
}
