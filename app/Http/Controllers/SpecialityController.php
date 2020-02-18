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

        $specNum = $student->getCountSpecialities(); //количество специальностей

	    $assSpecDivis = $student->getAssSpecDivis(); // асс-й массив, ключ -  имя спец, значение - имя факультета
	    if ($specNum <-2 && view()->exists('student.student-home')  ) {
		return redirect()->route('terms', $student->getAssSpecDivis()[0][0]);
	    }
	    if ($specNum >=1 && view()->exists('student.specialities')) {
		return view('student.specialities',['specialities'=>$assSpecDivis]);	//не забыть год и курс
	    }

	}

}
