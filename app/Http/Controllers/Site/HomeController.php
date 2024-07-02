<?php

namespace App\Http\Controllers\Site;

use App\Models\Book;
use App\Models\OrderItem;
use App\Models\ContactType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $contactTypes = ContactType::where('is_active', 1)->get();

        $latestBooks = Book::latest()->active()->limit(6)->get();

        $offerBooks = Book::active()->offers()->get();

        $strLimit = 30;

        // Get the IDs of the most sold books
        $mostSaledBooksIDs = OrderItem::select('book_id', DB::raw('count(book_id) as book_count'))
            ->groupBy('book_id')
            ->orderByDesc('book_count')
            ->distinct('book_id')
            ->pluck('book_id')->toArray();

        $mostSaledBooks = Book::active()->whereIn('id', $mostSaledBooksIDs)->get();

        $heroImg = Slider::where("key", 'home-hero')->first()->image;
        $contactUsImg = Slider::where("key", 'contact_us-section')->first()->image;

        return view("site.index", compact("contactTypes", "latestBooks", "mostSaledBooks", "offerBooks", "strLimit", 'heroImg', 'contactUsImg'));
    }
}
