<?php

namespace App\Http\Controllers\Site;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ContactRequest;
use App\Models\ContactType;

class ContactController extends Controller
{
    public function index()
    {
        $contactTypes = ContactType::active()->get();
        return view('site.contactus.index', compact('contactTypes'));
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
