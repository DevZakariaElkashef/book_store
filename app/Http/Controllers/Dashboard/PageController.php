<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UpdatePageRequest;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::paginate(10);

        return view("dashboard.pages.settings.pages.index", compact("pages"));
    }



    public function update(UpdatePageRequest $request, $id)
    {
        $page = Page::findOrFail($id);


        $page->update($request->all());


        // retun with toaster message
        $message = [
            'status' => true,
            'content' => __('updated successfully')
        ];

        return to_route('pages.index')->with('message', $message);
    }
}
