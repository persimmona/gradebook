<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudyCard;
use App\Models\StudyGroup;
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
        $terms = $student->getSemesters($studyCard->id);//который потом идет сюда
        $currentTerm = $terms[0];
        unset($terms[0]);
        return view('student.student-home', compact('student','terms', 'currentTerm'));

    }

}
