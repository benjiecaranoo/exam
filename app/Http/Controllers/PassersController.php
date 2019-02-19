<?php

namespace App\Http\Controllers;

use App\Passers;
use Illuminate\Http\Request;

use App\Http\Resources\Passers as PassersResource;

class PassersController extends Controller
{

    public function index()
    {
        $passersList = Passers::orderBy('name_of_examinee', 'asc')->paginate(50);
        return response()->json($passersList);
    }

    public function store(Request $request)
    {
        $newPassers = new Passers;
        $newPassers->name_of_examinee   = $request->input('name_of_examinee');
        $newPassers->campus_eligibility = $request->input('campus_eligibility');
        $newPassers->school     = $request->input('school');
        $newPassers->division   = $request->input('division');
        if($newPassers->save()) {
            return response()->json($newPassers);
        }
    }

    public function topSchool(){
        $toplist = Passers::groupBy('school')
                    ->selectRaw('count(*) as total, school')
                    ->orderBy('total', 'desc')
                    ->paginate(50);
        
        return response()->json($toplist);
    }

    public function show($keyword)
    {
        $search =  Passers::where(function ($query) use($keyword) {
            $query->where('name_of_examinee', 'like', '%' . $keyword . '%')
                    ->orWhere('campus_eligibility', 'like', '%' . $keyword . '%')
                    ->orWhere('division', 'like', '%' . $keyword . '%')
                    ->orWhere('school', 'like', '%' . $keyword . '%');
            })->paginate(50);

        return response()->json($search);
    }


}
