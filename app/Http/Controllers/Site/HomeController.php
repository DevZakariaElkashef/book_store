<?php

namespace App\Http\Controllers\Site;

use App\Models\Book;
use App\Models\ContactType;
use Illuminate\Http\Request;
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

        $mostSaledBooks = Book::getMostSoldBooks()->active()->paginate(6);

        $heroImg = Slider::where("key", 'home-hero')->first()->image;
        $contactUsImg = Slider::where("key", 'contact_us-section')->first()->image;
        $offerImg = Slider::where("key", 'offer-section')->first()->image;

        return view("site.index", compact("contactTypes", "latestBooks", "mostSaledBooks", "offerBooks", "strLimit", 'heroImg', 'contactUsImg', 'offerImg'));
    }
}
