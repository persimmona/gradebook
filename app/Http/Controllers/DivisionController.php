<?php

namespace App\Http\Controllers;

use App\Models\CurrentData;
use App\Models\Employer;
use App\Models\WnpDiscSemEmployer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DivisionController extends Controller
{
    public function index() // полчить для кафедры предметы
    {
        $wnpDiscSemEmps = collect();
        $currentData = CurrentData::first();
        $divisionId = Auth::guard('employer')->user()->division_id;
        $employers = Employer::where('division_id', $divisionId)->get();
        foreach ($employers as $employer){
            $wnpDiscSemEmps->push(WnpDiscSemEmployer::getCurrTermEmpDisc($employer->id, $currentData));
        }
        $wnpDiscSemEmps = $wnpDiscSemEmps->flatten()->unique('wnp_discipline_sem_id')->sortBy('id');
        $wnpDisciplineSems = $wnpDiscSemEmps->map->wnpDisciplineSem->flatten();
        return view('employer.division', compact('currentData', 'wnpDisciplineSems', 'employers'));
    }

    public function storeAddEditEmpTypeModal(Request $request)
    {
        if($request->employerId == 2)
            WnpDiscSemEmployer::updateOrCreate(['wnp_discipline_sem_id'=>$request->wnpDisciplineSemId,
            'employer_id'=>$request->employer_id, 'emp_type_id'=>2]);
        else
            WnpDiscSemEmployer::where('wnp_discipline_sem_id', $request->wnpDisciplineSemId)
                ->where('emp_type_id', 1)->update(['employer_id'=>$request->employer_id]);
        return redirect()->back();
    }

    public function destroyAddEditEmpTypeModal(Request $request)
    {
        WnpDiscSemEmployer::where('wnp_discipline_sem_id', $request->wnpDisciplineSemIdExc)
        ->where('emp_type_id', 2)->orderBy('id','desc')->first()->delete();
        return redirect()->back();
    }
}
