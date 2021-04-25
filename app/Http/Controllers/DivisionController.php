<?php

namespace App\Http\Controllers;

use App\Models\CurrentData;
use App\Models\Division;
use App\Models\Employer;
use App\Models\WnpDiscSemEmployer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DivisionController extends Controller
{
    /**
     * Show all divisions for dekanat role
     * @param
     * @variables user, faculty
     *
     */
    public function index()
    {
        $faculty = Auth::guard('employer')->user()->division;
        $divisions = Division::getDivisionsByFaculty($faculty->id);
        $facultyName = $faculty->division_name;
//        dd($divisions);
        return view('employer.dekanat.index',compact('facultyName', 'divisions'));

    }
    public function show() //get subjects of division
    {
        $wnpDiscSemEmps = collect();
        $currentData = CurrentData::first();
        $divisionId = Auth::guard('employer')->user()->division_id;
        $empDivisions = Employer::where('division_id', $divisionId)->get();
        foreach ($empDivisions as $empDivision){
            $wnpDiscSemEmps->push(WnpDiscSemEmployer::getCurrTermEmpDisc($empDivision->id, $currentData));
        }
        $wnpDiscSemEmps = $wnpDiscSemEmps->flatten()->unique('wnp_discipline_sem_id');
        $wnpDisciplineSems = $wnpDiscSemEmps->map->wnpDisciplineSem->flatten();
        $divisions = Division::all();

        return view('employer.division', compact('currentData', 'wnpDisciplineSems', 'divisions'));
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
