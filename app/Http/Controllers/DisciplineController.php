<?php

namespace App\Http\Controllers;

use App\Models\CurrentData;
use App\Models\Discipline;
use App\Models\WnpDisciplineSem;
use App\Models\WnpDiscSemEmployer;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    
    public function showMarks(WnpDisciplineSem $wnpDisciplineSem)
    {
        $testDisciplines = $wnpDisciplineSem->testDisciplines;
        return view('student.subject', compact('testDisciplines'));
    }

    public function showJournal(WnpDiscSemEmployer $wnpDiscSemEmployer)
    {
        $currentData = CurrentData::first();
        return view('employer.journal',compact('wnpDiscSemEmployer', 'currentData'));
    }

   
}
