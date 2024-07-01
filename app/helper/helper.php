<?php

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;



if (!function_exists('isActiveRoute')) {
    /**
     * Check if the given route is the current route.
     *
     * @param  string|array  $route
     * @param  string  $class
     * @return string
     */
    function isActiveRoute($route, $class = 'active')
    {
        if (is_array($route)) {
            foreach ($route as $r) {
                if (Route::is($r)) {
                    return $class;
                }
            }
        } else {
            if (Route::is($route)) {
                return $class;
            }
        }

        return '';
    }
}





function uploadeImage($file, $path, $oldPath = null)
{
    if ($oldPath && File::exists($oldPath)) {
        File::delete($oldPath);
    }

    // Get the file extension
    $fileExtension = $file->getClientOriginalExtension();

    // Generate a unique filename for the image
    $filename = 'image_' . time() . '.' . $fileExtension;


    $directory = 'uploads/' . $path;

    $file->move(public_path($directory), $filename);

    return $directory . '/' . $filename;
}




function hasFavourite($user, int $bookId): bool
{
    if ($user) {
        // Retrieve or create the user's favourite list
        $favouriteList = $user->getOrCreateFavourite();

        // Check if the book is in the user's favourite list
        $bookExists = $favouriteList->items()->where('book_id', $bookId)->exists();
        return $bookExists;
    }

    return false;
}

function bookCartCount(int $bookId): int
{
    $user = auth()->user();

    if ($user) {
        // Retrieve or create the user's favourite list
        $favouriteList = $user->getOrCreateCart();

        // Check if the book is in the user's favourite list
        $bookExists = $favouriteList->items()->where('book_id', $bookId)->first();
        if ($bookExists) {
            return $bookExists->qty;
        } else {
            return 0;
        }
    }

    return 0;
}
