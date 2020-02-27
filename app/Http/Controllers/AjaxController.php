<?php

namespace App\Http\Controllers;

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
        $a1 = $wnpDisciplineSem->testDisciplines()->a1()->sumTestResults();
        $a2 = $wnpDisciplineSem->testDisciplines()->a2()->sumTestResults();
        $sum = $a1 + $a2;
        $data .= "<tr>
                    <td>{$wnpDisciplineSem->discipline->discipline_name}</td>
                    <td>{$a1} / {$wnpDisciplineSem->testDisciplines()->a1()->sum('max_score')}</td>
                    <td>{$a2} / {$wnpDisciplineSem->testDisciplines()->a2()->sum('max_score')}</td>
                    <td>{$sum} / {$wnpDisciplineSem->testDisciplines()->maxScore()}</td>
                </tr>";
    }

        return $data;
    }
}
