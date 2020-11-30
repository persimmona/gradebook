<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WnpDiscSemEmployer extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $guarded = [];
    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function wnpDisciplineSem()
    {
        return $this->belongsTo(WnpDisciplineSem::class);
    }

    public function empType()
    {
        return $this->belongsTo(EmpType::class);
    }

    public static function getCurrTermEmpDisc($empId, $currentData)//cвязать еще с кафедрой
    {
        $currentSessionType = $currentData->current_session_type_id;
        $currentStudyYear = $currentData->current_study_year_id;

        $wnpDiscSemEmp = WnpDiscSemEmployer::
            join('wnp_discipline_sems', 'wnp_disc_sem_employers.wnp_discipline_sem_id', '=','wnp_discipline_sems.id')
            ->join('wnp_semesters', 'wnp_discipline_sems.wnp_semester_id', '=', 'wnp_semesters.id')
            ->join('wnp_titles', 'wnp_semesters.wnp_title_id', '=', 'wnp_titles.id')
            ->where([
                ['wnp_semesters.session_type_id', '=', $currentSessionType],
                ['wnp_titles.study_year_id', '=',$currentStudyYear],
                ['wnp_disc_sem_employers.employer_id', '=', $empId]
            ])
            ->select('wnp_disc_sem_employers.*')
            ->get();
        return $wnpDiscSemEmp;

    }

}
