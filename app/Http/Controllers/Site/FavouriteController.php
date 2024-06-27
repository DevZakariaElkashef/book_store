<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ToggleFavouriteRequest;
use App\Models\Book;
use App\Services\FavouriteService;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public $favouriteService;

    public function __construct(FavouriteService $favouriteService)
    {
        $this->favouriteService = $favouriteService;
    }
    public function index(Request $request)
    {
        $user = $request->user();

        $favourites = $user->getOrCreateFavourite();

        $strLimit = 30;

        return view("site.profile.favourites", compact('user', 'favourites', 'strLimit'));
    }


    public function toggle(ToggleFavouriteRequest $request)
    {
        $user = $request->user();
        $book = Book::findOrFail($request->input('book_id'));

        $message = $this->favouriteService->addBookToFavourite($user, $book);

        session()->flash("message", [
            'status' => true,
            'content' => $message
        ]);

        return redirect()->back();
    }
}
