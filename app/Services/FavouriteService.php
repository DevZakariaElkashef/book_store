<?php


namespace App\Services;

use App\Models\Book;
use App\Models\User;
use App\Models\CartItem;

class FavouriteService
{
    public function addBookToFavourite(User $user, Book $book)
    {
        $message = $user->addItemToFavourite($book);
        return $message;
    }
}
