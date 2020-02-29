<?php

namespace App\Http\Controllers;

use App\Models\TestDiscipline;
use App\Models\WnpSemester;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function show(Request $request)
    {
        $term = WnpSemester::getSemesterById($request->termId);
        $data = "<tr>
                    <th>Поточні предмети</th>
                    <th>А1</th>
                    <th>А2</th>
                    <th>Підсумки</th>
                </tr>";
    foreach($term->wnpDisciplineSems as $wnpDisciplineSem){
        $a1 = TestDiscipline::sumTestResultsA1($wnpDisciplineSem->testDisciplines);
        $a2 = TestDiscipline::sumTestResultsA2($wnpDisciplineSem->testDisciplines);
        $a1Max = TestDiscipline::getA1($wnpDisciplineSem->testDisciplines)->sum('max_score');
        $a2Max = TestDiscipline::getA2($wnpDisciplineSem->testDisciplines)->sum('max_score');
        $sum = TestDiscipline::sumTestResults($wnpDisciplineSem->testDisciplines);
        $data .= "<tr>
                    <td>{$wnpDisciplineSem->discipline->discipline_name}</td>
                    <td>{$a1} / {$a1Max}</td>
                    <td>{$a2} / {$a2Max}</td>
                    <td>{$sum} / 100</td>
                </tr>";
    }

        return $data;
    }
}
