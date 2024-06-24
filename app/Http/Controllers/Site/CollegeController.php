<?php

namespace App\Http\Controllers\Site;

use App\Models\Book;
use App\Models\College;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollegeController extends Controller
{
    public function show(Request $request, $id)
    {
        $college = College::findOrFail($id);

        if ($request->filled('subject')) {
            $subject = Subject::findOrFail($request->get('subject'));
        } else {
            $subject = null;
        }

        $colleges = College::where('university_id', $college->university_id)->get();

        $subjects = Subject::where("college_id", $id)->active()->latest()->get();

        $books = Book::whereHas("subject", function($subject)  use ($id) {
            $subject->where("college_id", $id);
        })->latest()->active()->get();

        $strLimit = 30;


        return view("site.colleges.show", compact("college", "colleges", "subject", "subjects","books", "strLimit"));
    }
}
