<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashbord\StoreSliderRequest;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::paginate(10);

        return view("dashboard.pages.settings.sliders.index", compact("sliders"));
    }




    public function update(StoreSliderRequest $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $data = $request->except('image');
        if ($request->hasFile('image')) {

            $data['image'] = uploadeImage($request->image, "Sliders", $slider->image);
        }

        $slider->update($data);


        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('sliders.index')->with('message', $message);
    }


    public function destroy(string $id)
    {
        Slider::where('id', $id)->delete();

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];

        return to_route('sliders.index')->with('message', $message);
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
        Slider::whereIn('id', $ids)->delete();
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];
        return back()->with('message', $message);
    }
}
