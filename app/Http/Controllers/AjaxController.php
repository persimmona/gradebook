<?php

namespace App\Http\Controllers;

use App\Models\TestDiscipline;
use App\Models\TestResult;
use App\Models\WnpSemester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function showStudDisciplines(Request $request)
    {
        $term = WnpSemester::getSemesterById($request->termId);
        $data = "<tr>
                    <th>Поточні предмети</th>
                    <th>Форма контролю</th>
                    <th>Підсумки</th>
                </tr>";
    foreach($term->wnpDisciplineSems as $wnpDisciplineSem){
//        $a1 = TestDiscipline::sumTestResultsA1($wnpDisciplineSem->testDisciplines);
//        $a2 = TestDiscipline::sumTestResultsA2($wnpDisciplineSem->testDisciplines);
//        $a1Max = TestDiscipline::getA1($wnpDisciplineSem->testDisciplines)->sum('max_score');
//        $a2Max = TestDiscipline::getA2($wnpDisciplineSem->testDisciplines)->sum('max_score');
        $sum = TestDiscipline::sumTestResults($wnpDisciplineSem->testDisciplines);
        $data .= "<tr>
                    <td>{$wnpDisciplineSem->discipline->discipline_name}</td>
                    <td>{$wnpDisciplineSem->studyType->study_type_name}</td>
                    <td>{$sum} / 100</td>
                </tr>";
    }

        return $data;
    }

    public function storeTestResult(Request $request)
    {
        $employerId = auth()->user()->id;

        DB::table('test_results')->updateOrInsert(
        [   'test_discipline_id' =>$request->testDisciplineId,
            'study_card_id' => $request->studyCardId,
        ],
        [
            'value' => $request->value,
            'employer_id' => $employerId,
        ]
        );
    }

    public function destroyTestResult(Request $request)
    {
        DB::table('test_results')->where([
            ['test_discipline_id',$request->testDisciplineId],
            ['study_card_id',$request->studyCardId]
        ])->delete();

    }
}
