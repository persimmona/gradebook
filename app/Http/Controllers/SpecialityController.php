<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\OsvitaLevel;
use App\Models\Speciality;
use App\Models\StudyGroup;
use App\Models\StudyCard;
use Illuminate\Support\Facades\Auth;

class SpecialityController extends Controller
{
	
    public function show()
    {
        $student = Auth::guard('student')->user();

        $studyCards=$student->studyCards;

        $studyCardsCount = count($studyCards);

        if ($studyCardsCount <2 && view()->exists('student.home')  ) {
		return redirect()->route('term', $studyCards[0]);
	    }
	    if ($studyCardsCount >=2 && view()->exists('student.specialities')) {
		return view('student.specialities',['studyCards'=>$studyCards]);
	    }
	}

}
