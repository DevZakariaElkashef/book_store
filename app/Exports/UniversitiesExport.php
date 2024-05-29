<?php

namespace App\Exports;

use App\Models\University;
use Maatwebsite\Excel\Concerns\FromCollection;

class UniversitiesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return University::all();
    }
}
