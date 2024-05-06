<?php

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

    return $directory . '/'. $filename;
}
