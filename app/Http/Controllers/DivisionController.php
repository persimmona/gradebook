<?php

namespace App\Http\Controllers;

use App\Models\CurrentData;
use App\Models\Employer;
use App\Models\WnpDiscSemEmployer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DivisionController extends Controller
{
    public function index()
    {
        $wnpDiscSemEmps = collect();
        $currentData = CurrentData::first();
        $divisionId = Auth::guard('employer')->user()->division_id;
        $employers = Employer::where('division_id', $divisionId)->get();
        foreach ($employers as $employer){
            $wnpDiscSemEmps->push(WnpDiscSemEmployer::getCurrTermEmpDisc($employer->id, $currentData)->where('emp_type_id', 1));
        }
        $wnpDiscSemEmps = $wnpDiscSemEmps->flatten();
        $wnpDisciplineSems = $wnpDiscSemEmps->map->wnpDisciplineSem->flatten();
        return view('employer.division', compact('currentData', 'wnpDisciplineSems', 'employers'));
    }

    public function storeAddEditEmpTypeModal()
    {
        WnpDiscSemEmployer::create(['wnp_discipline_sem_id'=>\request()->wnpDisciplineSemId,
            'employer_id'=>\request()->employer_id, 'emp_type_id'=>2]);
        return redirect()->back();
    }

    public function destroyAddEditEmpTypeModal()
    {

        WnpDiscSemEmployer::where('wnp_discipline_sem_id', \request()->wnpDisciplineSemIdExc)
            ->where('emp_type_id', 2)->orderBy('id','desc')->first()->delete();
        return redirect()->back();
    }
}
