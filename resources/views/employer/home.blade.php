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
                {{--<th>Опції</th>--}}
            </tr>
            @foreach($wnpDisciplineSems as $wnpDisciplineSem)
            <tr>
                <td><a href="{{route('discipline.showJournal', ['wnpDisciplineSem'=>$wnpDisciplineSem, 'slug'=>
                    Str::slug( $wnpDisciplineSem->discipline->discipline_name)])}}">{{ $wnpDisciplineSem->discipline->discipline_name}}</a></td>
                <td>{{ $wnpDisciplineSem->wnpSemester->wnpTitle->studyGroup->study_group_name}}</td>
                <td>{{ $wnpDisciplineSem->studyType->study_type_name}}</td>
                <td>{{ $wnpDisciplineSem->hour_total}}</td>
                <td>{{round( $wnpDisciplineSem->hour_total/30, 2)}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<script src="{{ asset('js/app.js')}}" defer></script>
@endsection
