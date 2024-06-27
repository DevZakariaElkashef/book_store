<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Slider;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = AboutUs::active()->latest()->get();

        $heroImg = Slider::where("key", "about_us-section")->first()->image;

        return view("site.aboutus.index", compact("abouts", 'heroImg'));


    }
}
