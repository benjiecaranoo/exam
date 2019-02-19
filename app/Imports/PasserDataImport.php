<?php

namespace App\Imports;

use App\Passers;
use Maatwebsite\Excel\Concerns\ToModel;

class PasserDataImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Passers([
            'name_of_examinee'     => $row[1],
            'campus_eligibility'    => $row[2], 
            'school' => $row[3],
            'division' => $row[4],
        ]);

      
    }

}
