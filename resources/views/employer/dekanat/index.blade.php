@extends("layout")

@section("title", "Викладач — Журнал Оцінок")

@section('content')
    <h1 class="data-title">{{$facultyName}}</h1>
        <div class="root__flex-container">
            @foreach($divisions as $division)
                <div class="root__flex-container-item">
                    <div class="data-subtitle division-subtitle">Кафедра {{Str::lower($division->division_name)}}</div>
                    <table class="data data_zebra">
                        @if($division->studyGroups->count())
                            @foreach($division->studyGroups as $studyGroup)
                                <tr>
                                    <td><a href="{{route("statement.index",$studyGroup->id)}}">{{$studyGroup->study_group_name}}</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>Немає даних</td>
                            </tr>
                        @endif
                    </table>
                </div>
            @endforeach
        </div>

@endsection
