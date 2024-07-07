<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UpdateSettingRequest;

class SettingController extends Controller
{
    public function index()
    {
        $this->authorize('settings.read');
        $setting = Setting::first();
        return view("dashboard.pages.settings.index", compact('setting'));
    }

    public function update(UpdateSettingRequest $request)
    {
        $this->authorize('settings.update');
        $setting = Setting::first();
        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            $data['logo'] = uploadeImage($request->logo, 'Setting', $setting->logo);
        }

        $setting->update($data);

        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('settings.index')->with('message', $message);
    }
}
