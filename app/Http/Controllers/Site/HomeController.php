<?php

namespace App\Http\Controllers\Site;

use App\Models\Book;
use App\Models\ContactType;
use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\Slider;
use App\Models\Subject;
use App\Models\University;

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


        $universites = University::active()->get();
        $colleges = College::active()->get();
        $subjects = Subject::active()->get();


        return view("site.index", compact("contactTypes", "universites", "subjects", "colleges", "latestBooks", "mostSaledBooks", "offerBooks", "strLimit", 'heroImg', 'contactUsImg', 'offerImg'));
    }
}
