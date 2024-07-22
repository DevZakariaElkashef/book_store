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
    public function index()
    {
        $usedBooks = Book::active()->used()->get();


        $universities = University::active()->get();
        $colleges = College::active()->get();
        $subjects = Subject::active()->latest()->get();

        $heroImg = Slider::where('key', 'used_books-section')->first()->image;

        $strLimit = 30;


        return view('site.books.used', compact('usedBooks', 'universities', 'strLimit', 'colleges', 'subjects', 'heroImg'));
    }
}
