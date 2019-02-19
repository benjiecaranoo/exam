<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\PasserListExport;
use App\Imports\PasserDataImport;
use Maatwebsite\Excel\Facades\Excel;
  
class MyController extends Controller
{

    public function import() 
    {
         Excel::import(new PasserDataImport,public_path('excel/convertcsv.xlsx'));
    }
}