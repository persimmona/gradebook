<?php

namespace App\Http\Controllers;

use App\Models\CurrentData;
use App\Models\Employer;
use App\Models\Student;
use App\Models\StudyCard;
use App\Models\StudyGroup;
use App\Models\WnpDisciplineSem;
use App\Models\WnpDiscSemEmployer;
use App\Models\WnpSemester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(StudyCard $studyCard)
    {
        $student = Auth::guard('student')->user();
        $terms = $student->getSemesters($studyCard->id);
        $currentTerm = $terms[0];
        unset($terms[0]);
        return view('student.home', compact('terms', 'currentTerm'));

    }

    public function showEmployerTerms()
    {
        $employer = Auth::guard('employer')->user();

        $currentData = CurrentData::first();
        $wnpDiscSemEmps = WnpDiscSemEmployer::getCurrTermEmpDisc($employer->id, $currentData);
        return view('employer.home', compact('currentData', 'wnpDiscSemEmps'));
    }

}
