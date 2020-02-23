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

    public function TestResults()
    {
        return $this->hasOne(TestResult::class, 'test_discipline_id');
    }

    public function attestation()
    {
        return $this->belongsTo(Attestation::class);
    }

    public function scopeA1($query) //оценки дисциплин, что относятся к 1 аттестации
    {
        return $query->with('TestResults')->where('attestation_id', 1);
    }

    public function scopeA2($query) //оценки дисциплин, что относятся ко 2 аттестации
    {
        return $query->with('TestResults')->where('attestation_id', 2);
    }

    public function scopeMaxScore($query) //максимальное значение набранных баллов в течение семестра
    {
        $max_score = $query->where('attestation_id', 3)->first()->max_score;
        return $max_score == 100 ? $max_score : 60;
    }

    public function scopeSumTestResults($query) //сумма оценок для аттестаций
    {
        return $query->get()->pluck('TestResults')->sum('value');
    }




}
