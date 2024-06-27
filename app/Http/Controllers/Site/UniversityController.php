<?php

namespace App\Http\Controllers\Site;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\Slider;

class UniversityController extends Controller
{
    public function index()
    {
        $universities = University::active()->latest()->get();

        $heroImg = Slider::where("key", 'universities-section')->first()->image;

        return view("site.universites.index", compact("universities", "heroImg"));
    }


    public function show($id)
    {
        $university = University::findOrFail($id);
        $colleges = College::where('university_id', $id)->get();

        return view("site.universites.show", compact('university', 'colleges'));
    }
}
