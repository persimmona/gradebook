<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestDiscipline extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function wnpDisciplineSem()
    {
        return $this->belongsTo(WnpDisciplineSem::class);
    }

    public function testResults()
    {
        return $this->hasMany(TestResult::class, 'test_discipline_id');
    }

    public function attestation()
    {
        return $this->belongsTo(Attestation::class);
    }

    public function studyType()
    {
        return $this->belongsTo(StudyType::class);
    }

    public function studySubtype()
    {
        return $this->belongsTo(StudySubtype::class);
    }

    public static function sumTestResultsA1($testDisciplines) //сумма оценок для аттестаций
    {
        return $testDisciplines->where('attestation_id', 1)->pluck('testResults')->flatten()->sum('value');
    }

    public static function sumTestResultsA1ByStudyCardId($testDisciplines, $studyCardId) //сумма оценок для аттестаций
    {
        return $testDisciplines->where('attestation_id', 1)->pluck('testResults')->flatten()->where('study_card_id',$studyCardId)->sum('value');
    }
    public static function sumTestResultsA2($testDisciplines) //сумма оценок для аттестаций
    {
        return $testDisciplines->where('attestation_id', 2)->pluck('testResults')->flatten()->sum('value');
    }
    public static function sumTestResultsA2ByStudyCardId($testDisciplines, $studyCardId) //сумма оценок для аттестаций
    {
        return $testDisciplines->where('attestation_id', 2)->pluck('testResults')->flatten()->where('study_card_id',$studyCardId)->sum('value');
    }

    public static function sumTestResults($testDisciplines) //сумма оценок для итогов
    {
        return $testDisciplines->pluck('testResults')->flatten()->sum('value');
    }
    public static function sumTestResultsByStudyCardId($testDisciplines, $studyCardId) //сумма оценок для итогов
    {
        return $testDisciplines->pluck('testResults')->flatten()->where('study_card_id',$studyCardId)->sum('value');
    }

    public static function getA1($testDisciplines) //получить все оценки для 1 аттестации
    {
        return $testDisciplines->where('attestation_id', 1)->sortBy('study_type_description')->sortBy(function($query){
            return $query->studyType->study_type_name;
        });
    }

    public static function getA2($testDisciplines) //получить все оценки для 2 аттестации
    {
        return $testDisciplines->where('attestation_id', 2);
    }

    public static function getA3($testDisciplines) //получить все оценки для 2 аттестации
    {
        return $testDisciplines->where('attestation_id', 3);
    }

    public function scopeGetA3($query)
    {
        return $query->where('attestation_id', 3)->first();
    }




}
