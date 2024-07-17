<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BookImage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function destroy($id)
    {
        BookImage::where('id', $id)->delete();

        $message = [
            'status' => true,
            'content' => __('deleted successfully')
        ];
        return back()->with('message', $message);
    }
}
