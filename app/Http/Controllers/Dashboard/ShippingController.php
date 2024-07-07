<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UpdateShippingRequest;

class ShippingController extends Controller
{
    public function index()
    {
        $this->authorize('settings.read');
        
        $setting = Setting::first();
        return view("dashboard.pages.settings.shippings", compact('setting'));
    }

    public function update(Request $request)
    {
        $this->authorize('settings.create');

        $setting = Setting::first();
        $data = $request->all();

        if (!isset($data['use_shiping'])) {
            $data['use_shiping'] = 0;
        }

        $setting->update($data);

        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('shippings.index')->with('message', $message);
    }
}
