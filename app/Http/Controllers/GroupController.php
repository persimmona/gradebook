<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\StudyGroup;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class GroupController extends Controller
{
    public function index($divisionId)
    {
        $division = Division::find($divisionId);
        $groups = $division->studyGroups()->orderBy('study_group_name')->get();
        foreach ($groups as $group) {
            $groupInfos[] = [
                'id'=>$group->id,
                'study_group_name'=>$group->study_group_name,
                'study_group_students_count'=>$group->getStudentsCount()
            ];
        }

        return view('employer.group-list', compact('groupInfos'));
    }

    public function getAjaxStudentList(Request $request)
    {
        $group = StudyGroup::find($request->groupId);
        $students = $group->students->toArray();
        return $students;
    }

    function filterData(&$str){

    }

    public function toExel(Request $request)
    {
        $groupIds = $request->groups;
        $data = $this->generateArray($groupIds);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet()
            ->fromArray(
                $data,  // The data to set
                NULL // Array values with this value will not be set
            );
        $sheet->getColumnDimension('A')->setWidth(35);

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="groups.xlsx"');
        $writer->save("php://output");
//        return redirect()->back();

    }
    private function generateArray($groupIds) {
        foreach ($groupIds as $groupId) {
            $group = StudyGroup::find($groupId);
            $students = $group->students->toArray();
            $data[] = ['Група - '.$group->study_group_name];
            $data[] = ['ПІБ'];
            if(!empty($students)) {
                foreach ($students as $student) {
                    $data[] = [
                        $student['last_name'].' '.$student['first_name'].' '.$student['middle_name']
                    ];
                }
            } else {
                $data[] = ['Немає записів'];
            }
            $data[] = [' '];
        }
        return $data;
    }

}
