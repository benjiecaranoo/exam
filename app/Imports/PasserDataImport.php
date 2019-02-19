<?php

namespace App\Imports;

use App\Passer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
class PasserDataImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // public function model(array $row)
    // {
    //     // echo "<pre>";
    //     // $someCounted = count($row);

    //     // for($i = 0; $i < $someCounted; $i++){
    //     //     echo $someCounted;
    //     // echo $row[$i];
    //     // }
    //     // echo "<pre>";
    //     // $i = 0;
    //     // foreach($row as $key => $value){
            
    //     //     if(isset($value)){
               
    //     //     }
    //     // }
    //     // return new Passer([
    //     //     'name_of_examinee'     => $value,
    //     //     'campus_eligibility'    => $value, 
    //     //     'school' => $value,
    //     //     'division' => $value,
    //     // ]);

      
    // }
    public function model(array $row)
    {
        echo "<pre>";
        print_r($row);
        // return new Passer([
        //     'name' => $row[0],
        // ]);
    }
    
    public function batchSize(): int
    {
        return 1000;
    }
    
    public function chunkSize(): int
    {
        return 1000;
    }
}
