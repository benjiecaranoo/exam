<?php

namespace App\Exports;

use App\Passer;
use Maatwebsite\Excel\Concerns\FromCollection;

class PasserListExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Passer::all();
    }
}
