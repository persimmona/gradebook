<?php

namespace App\Http\Controllers;

use App\Models\CurrentData;
use App\Models\Discipline;
use App\Models\StudySubtype;
use App\Models\TestDiscipline;
use App\Models\WnpDisciplineSem;
use App\Models\WnpDiscSemEmployer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DisciplineController extends Controller
{
    public function validation(Request $request)
    {
        return Validator::make($request->all(), [
            'max_score' => 'required|numeric',
            'study_type_description' => 'nullable|numeric'
        ], [
            'max_score.required' => 'Поля обов\'язкові для заповнення!',
            'max_score.numeric' => 'Запис повинен містить тільки цифри!',
        ]);
    }

    public function showMarks(WnpDisciplineSem $wnpDisciplineSem)
    {
        $testDisciplines = $wnpDisciplineSem->testDisciplines;
        return view('student.subject', compact('testDisciplines', 'wnpDisciplineSem'));
    }

    public function showJournal(WnpDisciplineSem $wnpDisciplineSem)
    {
        $currentData = CurrentData::first();

        return view('employer.journal', compact('wnpDisciplineSem', 'currentData'));
    }

    public function store(Request $request)
    {
        $data = $this->validation($request);
        if ($data->fails()) {
            return response()->json(['error' => $data->errors()->first()]);
        }
        try {
            TestDiscipline::create($request->all());
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Такий запис вже існує!']);
        }

    }

    public function storeCopy(Request $request)
    {

        $end = (int)$request->copyNum + 1;
        for($i = 1; $i<$end; $i++){
            $study_type_description = (int)$request->study_type_description+$i;
            TestDiscipline::create([
                'study_type_id' => $request->study_type_id,
                'study_type_description'=>$study_type_description,
                'max_score'=>$request->max_score,
                'study_sub_type_id'=>$request->study_sub_type_id,
                'attestation_id'=>$request->attestation_id,
                'wnp_discipline_sem_id'=>$request->wnp_discipline_sem_id,
            ]);
        }
    }

    public function showStudySubTypes(Request $request)
    {
        $studySubTypes = \App\Models\StudySubtype::getByStudyTypeId($request->study_type_id);
        $data = "<option value=\"\">Не обов'язково</option>";
        if(is_null($studySubTypes)){
            return $data;
        }else{
            foreach($studySubTypes as $studySubType){
                $data.="<option value=\"{$studySubType->id}\">{$studySubType->study_subtype_name}</option>";
            }
            return $data;
        }

    }

    public function edit($testDiscId)
    {
        $testDiscipline = TestDiscipline::find($testDiscId);
        $studySubTypes = \App\Models\StudySubtype::getByStudyTypeId($testDiscipline->study_type_id);
        $data = "<option value=\"\">Не обов'язково</option>";
        foreach($studySubTypes as $studySubType){
            $data.="<option value=\"{$studySubType->id}\">{$studySubType->study_subtype_name}</option>";
        }
        return response()->json(['study_type_description' => $testDiscipline->study_type_description,
            'max_score'=>$testDiscipline->max_score, 'attestation_id'=>$testDiscipline->attestation_id,
            'study_type_name'=>$testDiscipline->studyType->study_type_name,'study_type_id'=>$testDiscipline->study_type_id,
            'study_sub_type_name'=>empty($testDiscipline->studySubtype)?"Не обов'язково":
                $testDiscipline->studySubtype->study_subtype_name, 'study_sub_types'=>$data]);
    }

    public function update($testDiscId, Request $request)
    {
        $data = $this->validation($request);
        if ($data->fails()) {
            return response()->json(['error' => $data->errors()->first()]);
        }
        try {
            TestDiscipline::find($testDiscId)->update(['max_score'=>$request->max_score,
                'study_sub_type_id'=>$request->study_sub_type_id, 'attestation_id'=>$request->attestation_id]);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }

    public function destroy($testDiscId)
    {
        TestDiscipline::find($testDiscId)->delete();
    }


}