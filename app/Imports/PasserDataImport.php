<?php

namespace App\Imports;

use App\Passer;
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
        echo "<pre>";
        print_r($row);
        // foreach($row as $key => $value){
            
        //     if(isset($value)){
               
        //     }
        // }
        // return new Passer([
        //     'name_of_examinee'     => $value,
        //     'campus_eligibility'    => $value, 
        //     'school' => $value,
        //     'division' => $value,
        // ]);

      
    }

}
