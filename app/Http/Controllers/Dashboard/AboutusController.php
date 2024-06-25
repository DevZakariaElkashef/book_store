<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreAboutusRequest;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutusController extends Controller
{
    public function index()
    {
        $aboutus = AboutUs::paginate(10);

        return view("dashboard.pages.settings.aboutus.index", compact("aboutus"));
    }


    public function store(StoreAboutusRequest $request)
    {
        $data = $request->except('image');
        $data['image'] = uploadeImage($request->image, "Aboutus");

        AboutUs::create($data);

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('created successfully')
        ];

        return to_route('aboutus.index')->with('message', $message);
    }


    public function update(StoreAboutusRequest $request, $id)
    {
        $aboutus = AboutUs::findOrFail($id);

        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = uploadeImage($request->image, "Aboutus", $aboutus->image);
        }

        $aboutus->update($data);

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('aboutus.index')->with('message', $message);
    }


    public function destroy(string $id)
    {
        AboutUs::where('id', $id)->delete();

        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];

        return to_route('aboutus.index')->with('message', $message);
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
        AboutUs::whereIn('id', $ids)->delete();
        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];
        return back()->with('message', $message);
    }
}
