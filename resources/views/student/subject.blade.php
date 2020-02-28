@extends("layout")

@section("title", "Предмет — Журнал Оцінок")

@section('content')
<h1 class="data-title">5 семестр 2019-2020 навчального року</h1>
<p class="data-subtitle">Технології створення програмних продуктів</p>
<div class="root__overflow-container">
    <div class="root__data-container">
        <table class="data data--subj">
            <tr>
                <th>Форма контролю</th>
                <th>Оцінка</th>
                <th>А1</th>
                <th>А2</th>
            </tr>
            @foreach($testDisciplines as $testDiscipline)
            <tr>
                <td>{{$testDiscipline->studyType->study_type_name}}</td>
                <td><? echo $testDiscipline->testResults ? $testDiscipline->testResults->value : 0 ?> / {{$testDiscipline->max_score}}</td>
                <td><? echo $testDiscipline->attestation_id == 1 ?  '<span class="fat-plus">+</span>' : ''?></td>
                <td><? echo $testDiscipline->attestation_id == 2 ?  '<span class="fat-plus">+</span>' : ''?></td>
            </tr>
            @endforeach
            <tr class="data__total">
                <td>Підсумки</td>
                <td>{{\App\Models\TestDiscipline::sumTestResults($testDisciplines)}} / 100</td>
                <td>{{\App\Models\TestDiscipline::sumTestResultsA1($testDisciplines)}} /
                    {{\App\Models\TestDiscipline::getA1($testDisciplines)->sum('max_score')}}</td>
                <td>{{\App\Models\TestDiscipline::sumTestResultsA2($testDisciplines)}}  /
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