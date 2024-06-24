<?php

namespace App\Http\Controllers\Site;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\College;

class UniversityController extends Controller
{
    public function index()
    {
        $universities = University::active()->latest()->get();

        return view("site.universites.index", compact("universities"));
    }


    public function show($id)
    {
        $university = University::findOrFail($id);
        $colleges = College::where('university_id', $id)->get();

        return view("site.universites.show", compact('university', 'colleges'));
    }
}
