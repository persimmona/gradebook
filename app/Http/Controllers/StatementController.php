<?php

namespace App\Http\Controllers;

use App\Models\StudyGroup;
use App\Models\TestDiscipline;
use App\Models\WnpSemester;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class StatementController extends Controller
{
    /**
     * Show all statements for group divided by semesters
     * @param string $groupId
    */
    public function index($groupId)
    {
        try {
            $group = StudyGroup::findOrFail($groupId);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }
        $semesters = WnpSemester::getAllSemestersByStudyGroup($group);
//        dd($semesters);
        return view('employer.dekanat.semesters',compact('semesters','group'));
    }

    /**
     * Show info about attestation statement
     * @param string $groupId
     * @param string $wnpSemesterId
     * @param int $attestation
     */
    public function show($groupId,$wnpSemesterId,$attestation)
    {
        $group = StudyGroup::find($groupId);
        $wnpSemester = WnpSemester::find($wnpSemesterId);
        //Headers info
        $semester = $wnpSemester->semester_id;
        $sessionType = $wnpSemester->sessionType->session_type_name;
        $studyYear = $wnpSemester->wnpTitle->study_year_id;
        $counter = 1;
        $disciplineTitles = $wnpSemester->disciplines->pluck("discipline_name")->flatten();

        $studyCards = $group->studyCards;
        $wnpDisciplineSems = $wnpSemester->wnpDisciplineSems;
        if($studyCards->isEmpty()) {
            abort(404);
        }
        //Main Information
        $data = array();
        foreach ($studyCards as $studyCard) {
            $student = $studyCard->student->last_name." ".$studyCard->student->short_name;

            foreach ($wnpDisciplineSems as $wnpDisciplineSem) {
                $testDiscplines = $wnpDisciplineSem->testDisciplines;
                $sumTestResult = $attestation == 1 ? TestDiscipline::sumTestResultsA1ByStudyCardId($testDiscplines,$studyCard->id) :
                    TestDiscipline::sumTestResultsA2ByStudyCardId($testDiscplines,$studyCard);
                $data[$student][] = $sumTestResult;
            }
        }
        //Additional information about discipline
        foreach ($wnpDisciplineSems as $wnpDisciplineSem) {
            $successfulStudents = 0;
            $maxScore = $wnpDisciplineSem->testDisciplines->where('attestation_id',"!=", 3)->sum('max_score');
            foreach ($studyCards as $studyCard) {
                $testDiscplines = $wnpDisciplineSem->testDisciplines;
                $sumTestResult = $attestation == 1 ? TestDiscipline::sumTestResultsA1ByStudyCardId($testDiscplines,$studyCard->id) :
                    TestDiscipline::sumTestResultsA2ByStudyCardId($testDiscplines,$studyCard);
                if($maxScore > 0) {
                    $successfulStudents += $sumTestResult / $maxScore >= 0.6 ? 1 : 0;
                }
            }
            $successfulness[] = ($successfulStudents / $studyCards->count() * 100)."%";
            $discMaxScores[] = $maxScore;
            $mainTeachers[] = isset($wnpDisciplineSem->getEmpType1()->employer) ? $wnpDisciplineSem->getEmpType1()->employer->last_name." ".
                $wnpDisciplineSem->getEmpType1()->employer->short_name : "";
            $nullInfo[] = "";
        }
//        $disciplineInfos = [
//            "Максимальна кількість балів" => $discMaxScores,
//            "Успішність, %" => $successfulness,
//            "Якість, %" => $nullInfo,
//            "Кількість атоматів" => $nullInfo,
//            "Викладач" => $mainTeachers,
//            "Розпис" => $nullInfo
//        ];


        //проверка $studyCards и $wnpDisciplineSems на null
//        dd($disciplineInfos);
        return view('employer.dekanat.statement', compact('group', 'semester', 'sessionType', 'studyYear',
            'disciplineTitles', 'data', 'attestation', 'counter', 'mainTeachers', 'successfulness', 'discMaxScores', 'nullInfo'));
    }
    //GI3RNGVCMFZD study car
}
