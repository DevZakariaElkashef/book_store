<?php

namespace App\Http\Controllers\Site;

use App\Models\Book;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookReview;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::query();

        if ($request->filled('sort')) {
            if ($request->sort == 'latest') {
                $books->latest();
            } elseif ($request->sort == 'most-saled') {
                $books = Book::getMostSoldBooks();
            }
        }

        if ($request->filled('name')) {
            $books->where(function ($query) use ($request) {
                $query->where('name_ar', 'like', '%' . $request->name . '%')
                    ->orWhere('name_en', 'like', '%' . $request->name . '%')
                    ->orWhere('description_ar', 'like', '%' . $request->name . '%')
                    ->orWhere('description_en', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('university_id')) {
            $books->whereHas('subject', function ($subject) use ($request) {
                $subject->whereHas('college', function ($college) use ($request) {
                    $college->where('university_id', $request->university_id);
                });
            });
        }

        if ($request->filled('college_id')) {
            $books->whereHas('subject', function ($subject) use ($request) {
                $subject->where('college_id', $request->college_id);
            });
        }

        if ($request->filled('subject_id')) {
            $books->where('subject_id', $request->subject_id);
        }

        $books = $books->active()->paginate(9);


        $strLimit = 30;

        return view("site.books.index", compact("books", "strLimit"));
    }


    public function show(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $reviews = BookReview::whereHas('orderItem', function($item) use($id) {
            $item->where('book_id', $id);
        })->get();

        return view('site.books.show', compact('book', 'reviews'));
    }


    public function offers(Request $request)
    {
        $books = Book::active()->offers()->latest()->paginate(9);

        $strLimit = 30;

        $heroImg = Slider::where('key', 'offers-section')->first()->image;

        return view("site.books.offers", compact("books", "strLimit", 'heroImg'));
    }
}
