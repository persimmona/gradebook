@extends("layout")

@section("title", "Викладач — Журнал Оцінок")

@section('content')
<?
$testDisciplines = $wnpDiscSemEmployer->wnpDisciplineSem->testDisciplines;
$division = auth()->user()->division;
$currentStudyTypes = \App\Models\StudyType::getStudyTypesByDivisionId($division->id);
?>
<h1 class="data-title">{{$currentData->sessionType->semester_type_name}} семестр {{$currentData->current_study_year_id}} навчального року</h1>
<p class="data-subtitle">{{$wnpDiscSemEmployer->wnpDisciplineSem->discipline->discipline_name}}</p>
<p class="data-subtitle">{{$wnpDiscSemEmployer->wnpDisciplineSem->wnpSemester->wnpTitle->studyGroup->study_group_name}}</p>
@if(auth()->user()->postition_id != 565)
<button id="btnCreateStudyType" class="btn">Додати форму контролю</button>
@endif
<div class="root__overflow-container">
    <div class="root__data-container">

        <p class="data-text">
            @foreach($testDisciplines->unique('study_type_id') as $testDiscipline)
                @if(isset($testDiscipline->studyType))
                {{$testDiscipline->studyType->study_type_name}} &#8211; {{$testDiscipline->max_score}}&emsp;
                @endif
            @endforeach
        </p>
        <table class="journal">
          <tr>
                <td class="journal__corner">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <line x1="0" y1="0" x2="100%" y2="100%" stroke="#e8e8e8" stroke-width="2"/>
                    </svg>
                    <span class="journal__col-title">Контроль</span>
                    <span class="journal__row-title">Прізвище, ім'я студента</span>
                </td>
                @foreach(\App\Models\TestDiscipline::getA1($testDisciplines) as $testDiscipline)
                <th>
                    <span>{{$testDiscipline->studyType->study_type_short_name}} {{$testDiscipline->study_type_description}}</span>
                </th>
                @endforeach
                <th class="journal__expression"><span>Атестація 1</span></th>
                @foreach(\App\Models\TestDiscipline::getA2($testDisciplines) as $testDiscipline)
                    <th>
                        <span>{{$testDiscipline->studyType->study_type_short_name}} {{$testDiscipline->study_type_description}}</span>
                    </th>
                @endforeach
                <th class="journal__expression"><span>Атестація 2</span></th>
                @foreach(\App\Models\TestDiscipline::getA3($testDisciplines) as $testDiscipline)
                <th>
                    <span>{{$testDiscipline->studyType->study_type_short_name}} {{$testDiscipline->study_type_description}}</span>
                </th>
                @endforeach
                <th class="journal__expression"><span>Підсумки</span></th>
                <th class="journal__add" data-content=>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" fill="#6aa889"/>
                        <path d="M0 0h24v24H0z" fill="none"/>
                    </svg>
                </th>
            </tr>
            @foreach($wnpDiscSemEmployer->wnpDisciplineSem->wnpSemester->wnpTitle->studyGroup->studyCards()->orderByStudLastName() as $studyCard)
            <tr id="{{$studyCard->id}}">
                <td>{{$studyCard->student->last_name}} {{$studyCard->student->first_name}}</td>

                @foreach(\App\Models\TestDiscipline::getA1($testDisciplines) as $testDiscipline)

                <td id="{{$testDiscipline->id}}"><input type=text name=testResult id=testResult value="<? $testResult = \App\Models\TestResult::getByStudyCardId($studyCard, $testDiscipline);
                    echo isset($testResult) ? $testResult->value : '' ?>" <? if(isset($testDiscipline->studyType->edit_emp_type_id))
                        echo $wnpDiscSemEmployer->emp_type_id == 1?
                            '':'disabled'?> maxscore = {{$testDiscipline->max_score}}>
                </td>

                @endforeach

                <td class="journal__expression">{{\App\Models\TestDiscipline::sumTestResultsA1ByStudyCardId($testDisciplines, $studyCard->id)}} </td>

                @foreach(\App\Models\TestDiscipline::getA2($testDisciplines) as $testDiscipline)
                    <td id="{{$testDiscipline->id}}"><input type=text name=testResult id=testResult value="<? $testResult = \App\Models\TestResult::getByStudyCardId($studyCard, $testDiscipline);
                        echo isset($testResult) ? $testResult->value : '' ?>" <? if(isset($testDiscipline->studyType->edit_emp_type_id))
                            echo $wnpDiscSemEmployer->emp_type_id == 1?
                                '':'disabled'?> maxscore = {{$testDiscipline->max_score}}>
                    </td>

                @endforeach

                <td class="journal__expression">{{\App\Models\TestDiscipline::sumTestResultsA2ByStudyCardId($testDisciplines, $studyCard->id)}}</td>

                @foreach(\App\Models\TestDiscipline::getA3($testDisciplines) as $testDiscipline)
                <td  id="{{$testDiscipline->id}}">
                    <input type=text name=testResult id=testResult value="<? $testResult =
                        \App\Models\TestResult::getByStudyCardId($studyCard, $testDiscipline);
                    echo isset($testResult) ? $testResult->value : '' ?>" <? if(isset($testDiscipline->studyType->edit_emp_type_id))
                        echo $wnpDiscSemEmployer->emp_type_id == 1?
                        '':'disabled'?> maxscore = {{$testDiscipline->max_score}}>
                </td>
                @endforeach

                <td class="journal__expression">{{\App\Models\TestDiscipline::sumTestResultsByStudyCardId($testDisciplines, $studyCard->id)}}</td>
            </tr>
            @endforeach
            </table>
    </div>
</div>
@if($wnpDiscSemEmployer->emp_type_id==1)
<div class="home-link-container home-link-container_journal">
    <a class="home-link" href="/">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
            <path class="stroke" fill="#fff" d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"/>
            <path fill="none" d="M0 0h24v24H0z"/>
        </svg>
        На головну
    </a>
</div>
@endif

@include('employer.study_type.create')
@include('employer.test_discipline.create')
@include('employer.test_discipline.copy')
@include('employer.test_discipline.exception')


<script src="{{ asset('js/app.js')}}" defer></script>
@endsection