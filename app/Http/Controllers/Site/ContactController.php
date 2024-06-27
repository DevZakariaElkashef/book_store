<?php

namespace App\Http\Controllers\Site;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ContactRequest;
use App\Models\ContactType;
use App\Models\Slider;

class ContactController extends Controller
{
    public function index()
    {
        $contactTypes = ContactType::active()->get();
        $heroImg = Slider::where("key", 'contact_us-section')->first()->image;
        return view('site.contactus.index', compact('contactTypes', 'heroImg'));
    }


    public function store(ContactRequest $request)
    {
        Contact::create($request->all());

        session()->flash("message", [
            'status' => true,
            'content' => __("message sent success")
        ]);

        return redirect()->back();
    }
}
