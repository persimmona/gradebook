@extends("layout")

@section("title", "Викладач — Журнал Оцінок")

@section('content')
<h1 class="data-title">{{$currentData->sessionType->semester_type_name}} семестр {{$currentData->current_study_year_id}} навчального року</h1>
<p class="data-subtitle">{{$wnpDiscSemEmployer->wnpDisciplineSem->discipline->discipline_name}}</p>
<p class="data-subtitle">{{$wnpDiscSemEmployer->wnpDisciplineSem->wnpSemester->wnpTitle->studyGroup->study_group_name}}</p>
<div class="root__overflow-container">
    <div class="root__data-container">
        <table class="journal">
            <tr>
                <td class="journal__corner">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <line x1="0" y1="0" x2="100%" y2="100%" stroke="#e8e8e8" stroke-width="2"/>
                    </svg>
                    <span class="journal__col-title">Форма контролю</span>
                    <span class="journal__row-title">Прізвище, ім'я студента</span>
                </td>
                @foreach(\App\Models\TestDiscipline::getA1($wnpDiscSemEmployer->wnpDisciplineSem->testDisciplines) as $testDiscipline)
                <th><span>{{$testDiscipline->studyType->study_type_short_name}}</span></th>
                @endforeach
                <th class="journal__expression"><span>Атестація 1</span></th>
                @foreach(\App\Models\TestDiscipline::getA2($wnpDiscSemEmployer->wnpDisciplineSem->testDisciplines) as $testDiscipline)
                    <th><span>{{$testDiscipline->studyType->study_type_short_name}}</span></th>
                @endforeach
                <th class="journal__expression"><span>Атестація 2</span></th>
                    <th><span>{{$wnpDiscSemEmployer->wnpDisciplineSem->testDisciplines()->getA3()->studyType->study_type_short_name}}</span></th>
                <th class="journal__expression"><span>Підсумки</span></th>
                <th class="journal__add">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" fill="#6aa889"/>
                        <path d="M0 0h24v24H0z" fill="none"/>
                    </svg>
                </th>
            </tr>
            @foreach($wnpDiscSemEmployer->wnpDisciplineSem->wnpSemester->wnpTitle->studyGroup->studyCards as $studyCard)
            <tr>
                <td>{{$studyCard->student->last_name}} {{$studyCard->student->first_name}}</td>
                @foreach(\App\Models\TestDiscipline::getA1($wnpDiscSemEmployer->wnpDisciplineSem->testDisciplines) as $testDiscipline)
                <td><input type=text name=stud_id id=stud_id value="<? $testResult = \App\Models\TestResult::getByStudyCardId($studyCard, $testDiscipline);
                    echo isset($testResult) ? $testResult->value : '' ?>" <? if(isset($testDiscipline->studyType->edit_emp_type_id))
                        echo $wnpDiscSemEmployer->emp_type_id == $testDiscipline->studyType->edit_emp_type_id?
                            '':'disabled'?>>
                </td>
                @endforeach
                <td class="journal__expression"></td>
                @foreach(\App\Models\TestDiscipline::getA2($wnpDiscSemEmployer->wnpDisciplineSem->testDisciplines) as $testDiscipline)
                    <td><input type=text name=stud_id id=stud_id value="<? $testResult = \App\Models\TestResult::getByStudyCardId($studyCard, $testDiscipline);
                        echo isset($testResult) ? $testResult->value : '' ?>" <? if(isset($testDiscipline->studyType->edit_emp_type_id))
                            echo $wnpDiscSemEmployer->emp_type_id == $testDiscipline->studyType->edit_emp_type_id?
                                '':'disabled'?>>
                    </td>
                @endforeach
                <td class="journal__expression"></td>
                <td><input type=text name=stud_id id=stud_id value="<? $testResult = \App\Models\TestResult::getByStudyCardId($studyCard, $wnpDiscSemEmployer->wnpDisciplineSem->testDisciplines()->getA3());
                    echo isset($testResult) ? $testResult->value : '' ?>" <? if(isset($testDiscipline->studyType->edit_emp_type_id))
                        echo $wnpDiscSemEmployer->emp_type_id == $testDiscipline->studyType->edit_emp_type_id?
                        '':'disabled'?>></td>
                <td class="journal__expression"></td>
            </tr>
            @endforeach
            </table>
    </div>
</div>

<div class="home-link-container home-link-container_journal">
    <a class="home-link" href="/">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
            <path class="stroke" fill="#fff" d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"/>
            <path fill="none" d="M0 0h24v24H0z"/>
        </svg>
        На головну
    </a>
</div>
@endsection