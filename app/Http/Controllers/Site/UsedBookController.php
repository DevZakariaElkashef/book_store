<?php

namespace App\Http\Controllers\Site;

use App\Models\Book;
use App\Models\College;
use App\Models\Subject;
use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;

class UsedBookController extends Controller
{
    public function index(Request $request)
    {
        $usedBooks = Book::query();

        if ($request->filled('sort')) {
            if ($request->sort == 'latest') {
                $usedBooks->latest();
            } elseif ($request->sort == 'most-saled') {
                $usedBooks = Book::getMostSoldBooks();
            }
        }

        if ($request->filled('name')) {
            $usedBooks->where(function ($query) use ($request) {
                $query->where('name_ar', 'like', '%' . $request->name . '%')
                    ->orWhere('name_en', 'like', '%' . $request->name . '%')
                    ->orWhere('description_ar', 'like', '%' . $request->name . '%')
                    ->orWhere('description_en', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('university_id')) {
            $usedBooks->whereHas('subject', function ($subject) use ($request) {
                $subject->whereHas('college', function ($college) use ($request) {
                    $college->where('university_id', $request->university_id);
                });
            });
        }

        dd($request->university_id);

        if ($request->filled('college_id')) {
            $usedBooks->whereHas('subject', function ($subject) use ($request) {
                $subject->where('college_id', $request->college_id);
            });
        }

        if ($request->filled('subject_id')) {
            $usedBooks->where('subject_id', $request->subject_id);
        }

        $usedBooks = $usedBooks->active()->used()->paginate(9);


        $universities = University::active()->get();
        $colleges = College::active()->get();
        $subjects = Subject::active()->latest()->get();

        $heroImg = Slider::where('key', 'used_books-section')->first()->image;

        $strLimit = 30;


        return view('site.books.used', compact('usedBooks', 'universities', 'strLimit', 'colleges', 'subjects', 'heroImg'));
    }
}
