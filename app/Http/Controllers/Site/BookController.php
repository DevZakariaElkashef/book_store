<?php

namespace App\Http\Controllers\Site;

use App\Models\Book;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::query();

        if ($request->filled('sort') && $request->sort == 'latest') {
            $books = $books->latest();
        }

        if ($request->filled('sort') && $request->sort == 'most-saled') {
            $books = Book::getMostSoldBooks();
        }

        $books = $books->active()->paginate(9);

        $strLimit = 30;

        return view("site.books.index", compact("books", "strLimit"));
    }

    
    public function offers(Request $request)
    {
        $books = Book::active()->offers()->latest()->paginate(9);

        $strLimit = 30;

        $heroImg = Slider::where('key', 'offers-section')->first()->image;

        return view("site.books.offers", compact("books", "strLimit", 'heroImg'));
    }
}
