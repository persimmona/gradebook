<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestDiscipline extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    public function wnpDisciplineSem()
    {
        return $this->belongsTo(WnpDisciplineSem::class);
    }

    public function testResults()
    {
        return $this->hasOne(TestResult::class, 'test_discipline_id');
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

    public function scopeTestDisciplinesOrdered($query)//возвращает только те предметы, где уже есть оценки
    {
        return $query->has('testResults')->orderBy('attestation_id')->get();
    }
//
//    public function scopeA1($query) //оценки дисциплин, что относятся к 1 аттестации
//    {
//        return $query->with('testResults')->where('attestation_id', 1);
//    }
//
//    public function scopeA2($query) //оценки дисциплин, что относятся ко 2 аттестации
//    {
//        return $query->with('testResults')->where('attestation_id', 2);
//    }

//    public function scopeMaxScore($query) //максимальное значение набранных баллов в течение семестра
//    {
//        $max_score = $query->where('attestation_id', 3)->first()->max_score;
//        return $max_score == 100.00 ? floor($max_score) : 60;
//    }

//    public function scopeSumTestResults($query) //сумма оценок для аттестаций
//    {
//        return $query->get()->pluck('testResults')->sum('value');
//    }

    public static function sumTestResultsA1($testDisciplines) //сумма оценок для аттестаций
    {
        return $testDisciplines->where('attestation_id', 1)->pluck('testResults')->sum('value');
    }

    public static function sumTestResultsA2($testDisciplines) //сумма оценок для аттестаций
    {
        return $testDisciplines->where('attestation_id', 2)->pluck('testResults')->sum('value');
    }

    public static function sumTestResults($testDisciplines) //сумма оценок для аттестаций
    {
        return $testDisciplines->pluck('testResults')->sum('value');
    }

    public static function getA1($testDisciplines) //сумма оценок для аттестаций
    {
        return $testDisciplines->where('attestation_id', 1);
    }

    public static function getA2($testDisciplines) //сумма оценок для аттестаций
    {
        return $testDisciplines->where('attestation_id', 2);
    }




}
