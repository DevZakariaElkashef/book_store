<?php


namespace App\Services;

use App\Models\User;
use App\Models\Book;

class CartService
{
    public function addBookToCart(User $user, Book $book, $count)
    {
        $message = $user->addItemToCart($book, $count);
        return $message;
    }
}
