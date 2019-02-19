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
        $count = 0;
        foreach($row as $key => $value){
            $count++;
            if(isset($value)){
                echo $count;
                print_r("---".$value);
            }
          
        }
        // return new Passer([
        //     'name_of_examinee'     => $row[0],
        //     'campus_eligibility'    => $row[1], 
        //     'school' => $row[2],
        //     'division' => $row[3],
        // ]);
    }
}
