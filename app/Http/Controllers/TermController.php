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
        $currentTerm = $student->getCurrentSemester($studyCard->id);
        if(empty($currentTerm)) {
            return view('student.home', compact('studyCard', 'terms'),
                ['currentTermNoData' => "Немає даних для поточного семестру"]);
        }
        if(empty($terms)) {
            return view('student.home', compact('studyCard', 'terms'),
                ['termNoData' => "Немає даних для попередніх семестів"]);
        }
        return view('student.home', compact('terms', 'currentTerm', 'studyCard'));
    }

    public function showEmployerTerms()
    {
        $employer = Auth::guard('employer')->user();

        $currentData = CurrentData::first();
        $wnpDiscSemEmps = WnpDiscSemEmployer::getCurrTermEmpDisc($employer->id, $currentData);
//        dd($wnpDiscSemEmps->map->wnpDisciplineSem->flatten());
        $wnpDisciplineSems = $wnpDiscSemEmps->map->wnpDisciplineSem->flatten();
        return view('employer.home', compact('currentData', 'wnpDisciplineSems'));
    }

}
