@extends("layout")

@section("title", "Предмет — Журнал Оцінок")

@section('content')


<div class="root__overflow-container">
    <div class="root__data-container">
        <p class="data-text mt-5">{{$wnpDisciplineSem->wnpSemester->wnpTitle->studyGroup->faculty()->division_name}} &#8211;
            {{$wnpDisciplineSem->wnpSemester->wnpTitle->studyGroup->studyProgram->speciality->speciality_name}} &#8211;
            {{$wnpDisciplineSem->wnpSemester->wnpTitle->studyGroup->study_group_name}}</p>
        <h1 class="data-title mt-2">{{$wnpDisciplineSem->wnpSemester->semester_id}} семестр {{$wnpDisciplineSem->wnpSemester->wnpTitle->study_year_id}} навчального року</h1>
        <p class="data-subtitle">{{$wnpDisciplineSem->discipline->discipline_name}}</p>
        <table class="data data--subj data_zebra">
            <tr>
                <th>Контроль</th>
                <th>Оцінка</th>
                <th>А1</th>
                <th>А2</th>
            </tr>
            @foreach($testDisciplines as $testDiscipline)
            <tr>
                <td>{{$testDiscipline->studyType->study_type_name}} {{$testDiscipline->study_type_description}}</td>
                <td><? echo isset($testDiscipline->testResults[0]) ? $testDiscipline->testResults[0]->value : 0 ?> / {{$testDiscipline->max_score}}</td>
                <td><? echo $testDiscipline->attestation_id == 1 ?  '<span class="fat-plus">+</span>' : ''?></td>
                <td><? echo $testDiscipline->attestation_id == 2 ?  '<span class="fat-plus">+</span>' : ''?></td>
            </tr>
            @endforeach
            <tr class="data__total">
                <td>Підсумки</td>
                <td>{{\App\Models\TestDiscipline::sumTestResultsByStudyCardId($testDisciplines, $studyCard->id)}} / 100</td>
                <td>{{\App\Models\TestDiscipline::sumTestResultsA1ByStudyCardId($testDisciplines, $studyCard->id)}} /
                    {{\App\Models\TestDiscipline::getA1($testDisciplines)->sum('max_score')}}</td>
                <td>{{\App\Models\TestDiscipline::sumTestResultsA2ByStudyCardId($testDisciplines, $studyCard->id)}}  /
                    {{\App\Models\TestDiscipline::getA2($testDisciplines)->sum('max_score')}}</td>
            </tr>
        </table>
    </div>
</div>

<div class="home-link-container">
    <a class="home-link" href="{{back()->getTargetUrl()}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
            <path class="stroke" fill="#fff" d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"/>
            <path fill="none" d="M0 0h24v24H0z"/>
        </svg>
        На головну
    </a>
</div>

<footer class="footer"></footer>

<script src="{{ asset('js/app.js')}}" defer></script>
@endsection