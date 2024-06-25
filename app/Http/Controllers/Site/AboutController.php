<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = AboutUs::active()->latest()->get();

        return view("site.aboutus.index", compact("abouts"));


    }
}
