@extends("layout")

@section("title", "Студент — Журнал Оцінок")

@section('content')

    <h1 class="data-title">{{$currentTerm->semester_id }} семестр {{$currentTerm->wnpTitle->study_year_id}} навчального року</h1>
    <div class="root__overflow-container">
        <div class="root__data-container">
            <table class="data">
                <tr>
                    <th>Поточні предмети</th>
                    <th>А1</th>
                    <th>А2</th>
                    <th>Підсумки</th>
                </tr>
                @foreach($currentTerm->wnpDisciplineSems as $wnpDisciplineSem)<!--лучше выводить disSem-->
                <tr>
                    <td>{{$wnpDisciplineSem->discipline->discipline_name}}</td>
                    <td>{{$a1 = $wnpDisciplineSem->testDisciplines()->a1()->sumTestResults()}} /
                        {{$wnpDisciplineSem->testDisciplines()->a1()->sum('max_score')}}</td>
                    <td>{{$a2 = $wnpDisciplineSem->testDisciplines()->a2()->sumTestResults()}} /
                        {{$wnpDisciplineSem->testDisciplines()->a2()->sum('max_score')}}</td>
                    <td>{{$a1 + $a2}}
                        / {{$currentTerm->wnpDisciplineSems[3]->testDisciplines()->maxScore()}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="data-tab root__data-tab">
        <div class="data-tab__container">
            @foreach($terms as $term)
            <a class="data-tab__item" href="#">
              <svg class="forward-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="#2a2a2a" d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"/>
                    <path fill="none" d="M0 0h24v24H0z"/>
                </svg>
                {{$term->semester_id}} семестр {{$term->wnpTitle->study_year_id}} навчального року
            </a>
            @endforeach
        </div>
    </div>

    <footer class="footer"></footer>

    <script src="{{ asset('js/app.js')}}" defer>

    </script>
@endsection