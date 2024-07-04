<?php

namespace App\Exports;

use App\Models\BookReview;
use Maatwebsite\Excel\Concerns\FromCollection;

class BookReviewExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BookReview::all();
    }
}
