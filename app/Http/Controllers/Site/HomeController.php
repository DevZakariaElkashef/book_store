<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ContactType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $contactTypes = ContactType::where('is_active', 1)->get();

        return view("site.index", compact("contactTypes"));
    }
}
