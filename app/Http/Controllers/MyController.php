<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\PasserListExport;
use App\Imports\PasserDataImport;
use Maatwebsite\Excel\Facades\Excel;
  
class MyController extends Controller
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function importExportView()
    // {
    //    return view('import');
    // }
   
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function export() 
    // {
    //     return Excel::download(new PasserListExport, 'users.xlsx');
    // }
   
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    public function import() 
    {
        //echo "asdfasdf"
     //   echo );
        Excel::import(new PasserDataImport,public_path('excel/passers.xlsx'));
           
        //return back();
    }
}