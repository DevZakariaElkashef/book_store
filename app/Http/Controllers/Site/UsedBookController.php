<?php

namespace App\Http\Controllers\Site;

use App\Models\Book;
use App\Models\College;
use App\Models\Subject;
use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsedBookController extends Controller
{
    public function index()
    {
        $books = Book::active()->used()->get();

        $universities = University::active()->get();
        $colleges = College::active()->get();
        $subjects = Subject::active()->latest()->get();



        $strLimit = 30;


        return view('site.books.used', compact('books', 'universities', 'strLimit', 'colleges', 'subjects'));
    }
}
