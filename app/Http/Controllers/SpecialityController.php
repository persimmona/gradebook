<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\OsvitaLevel;
use App\Models\Speciality;
use App\Models\StudyGroups;
use App\Models\StudyCard;

class SpecialityController extends Controller
{
	
    public function show()
    {
		
	$student = Student::find('IB93OC1K3FPD'); //приходит студент типа авториз-й

	$specNum = $student->getCountSpecialities(); //количество специальностей 

	$assSpecDivis = $student->getAssSpecDivis(); // асс-й массив, ключ -  имя спец, значение - имя факультета

	 if ($specNum <2 && view()->exists('student.student-home')  ) { 
		return view('student.student-home');
	 }
	 if ($specNum >=2 && view()->exists('student.specialities')) {
		return view('student.specialities',['specialities'=>$assSpecDivis]);	//не забыть год и курс
	 }

	}
	
  
}
