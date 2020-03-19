@extends("layout")

@section("title", "Викладач — Журнал Оцінок")

@section('content')
<h1 class="data-title">{{$currentData->sessionType->semester_type_name}} семестр {{$currentData->current_study_year_id}} навчального року</h1>
<div class="root__overflow-container">
    <div class="root__data-container">
        <table class="data data_zebra">
            <tr>
                <th>Поточні предмети</th>
                <th>Група</th>
                <th>Кінцева форма контролю</th>
                <th>Кількість годин</th>
                <th>Кількість кредитів</th>
                <th>Опції</th>
            </tr>
            @foreach($wnpDiscSemEmps as $wnpDiscSemEmp)
            <tr>
                <td><a href="{{route('discipline.showJournal', ['wnpDiscSemEmployer'=>$wnpDiscSemEmp, 'slug'=>
                    Str::slug($wnpDiscSemEmp->wnpDisciplineSem->discipline->discipline_name)])}}">{{$wnpDiscSemEmp->wnpDisciplineSem->discipline->discipline_name}}</a></td>
                <td>{{$wnpDiscSemEmp->wnpDisciplineSem->wnpSemester->wnpTitle->studyGroup->study_group_name}}</td>
                <td>{{$wnpDiscSemEmp->wnpDisciplineSem->studyType->study_type_name}}</td>
                <td>{{$wnpDiscSemEmp->wnpDisciplineSem->hour_total}}</td>
                <td>{{round($wnpDiscSemEmp->wnpDisciplineSem->hour_total/30, 2)}}</td>
                <td>
                    <div class="data-options">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                            <path d="M0 0h24v24H0z" fill="none"/>
                            <path d="M6 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm12 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-6 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" fill="#fff"/>
                        </svg>
                        <ul class="data-options__list">
                            <li class="data-options__item">
                                <a class="data-options__link" href="{{route('discipline.showJournal', ['wnpDiscSemEmployer'=>$wnpDiscSemEmp, 'slug'=>
                    Str::slug($wnpDiscSemEmp->wnpDisciplineSem->discipline->discipline_name)])}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                                    </svg>
                                    <span>Перейти</span>
                                </a>
                            </li>
                            <li class="data-options__item">
                                <a class="data-options__link" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                                        <path d="M0 0h24v24H0z" fill="none"/>
                                    </svg>
                                    <span>Додати контроль</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<footer class="footer"></footer>

<script src="{{ asset('js/app.js')}}" defer></script>
@endsection
