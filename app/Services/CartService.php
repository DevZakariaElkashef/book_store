<?php


namespace App\Services;

use App\Models\User;
use App\Models\Book;

class CartService
{
    public function addBookToCart(User $user, Book $book)
    {
        $message = $user->addItemToCart($book);
        return $message;
    }
}
