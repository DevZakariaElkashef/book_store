<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function index()
    {
        $terms = Page::where('key_en', 'Terms and Conditions')->first();

        return view("site.pages.terms", compact('terms'));
    }
}
