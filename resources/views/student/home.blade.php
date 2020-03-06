@extends("layout")

@section("title", "Студент — Журнал Оцінок")

@section('content')

    <h1 class="data-title">{{$currentTerm->semester_id }} семестр {{$currentTerm->wnpTitle->study_year_id}} навчального року</h1>
    <div class="root__overflow-container">
        <div class="root__data-container">
            <table class="data data_zebra">
                <tr>
                    <th>Поточні предмети</th>
                    <th>А1</th>
                    <th>А2</th>
                    <th>Підсумки</th>
                </tr>
                @foreach($currentTerm->wnpDisciplineSems as $wnpDisciplineSem)
                <tr>
                    <td><a href="{{route('discipline.show', ['wnpDisciplineSem'=>$wnpDisciplineSem, 'slug'=>
                    Str::slug($wnpDisciplineSem->discipline->discipline_name)])}}">{{$wnpDisciplineSem->discipline->discipline_name}}</a></td>
                    <td>{{\App\Models\TestDiscipline::sumTestResultsA1($wnpDisciplineSem->testDisciplines)}} /
                        {{\App\Models\TestDiscipline::getA1($wnpDisciplineSem->testDisciplines)->sum('max_score')}}</td>
                    <td>{{\App\Models\TestDiscipline::sumTestResultsA2($wnpDisciplineSem->testDisciplines)}} /
                        {{\App\Models\TestDiscipline::getA2($wnpDisciplineSem->testDisciplines)->sum('max_score')}}</td>
                    <td>{{\App\Models\TestDiscipline::sumTestResults($wnpDisciplineSem->testDisciplines)}} / 100</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="data-tab root__data-tab">
        <div class="data-tab__container">
            @foreach($terms as $term)
            <a class="data-tab__item" href="#" data-id="{{$term->id}}">
              <svg class="forward-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="#2a2a2a" d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"/>
                    <path fill="none" d="M0 0h24v24H0z"/>
                </svg>
                {{$term->semester_id}} семестр {{$term->wnpTitle->study_year_id}} навчального року
            </a>
            <table class="data data_zebra data{{$term->id}}"></table>
            @endforeach
        </div>
    </div>

    <footer class="footer"></footer>

    <script src="{{ asset('js/app.js')}}" defer></script>
@endsection