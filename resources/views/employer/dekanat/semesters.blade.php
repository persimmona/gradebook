@extends("layout")

@section("title", "Викладач — Журнал Оцінок")

@section('content')
    <h1 class="data-title">Атестаційні відомості {{$group->study_group_name}}</h1>
    <div class="root__flex-column-container">
        @foreach($semesters as $semester)
            <div class="data-subtitle">{{$semester->sessionType->semester_type_name}} семестер {{$semester->wnpTitle->study_year_id}} начального року</div>
            <div class="semester-wrap">
                <a href="{{route('statement.show',["group"=>$group->id,"semester"=>$semester->id,"attestation"=>1])}}" class="btn btn-link">
                    Атестація 1
                </a>
                <a href="{{route('statement.show',["group"=>$group->id,"semester"=>$semester->id,"attestation"=>2])}}" class="btn btn-link">
                    Атестація 2
                </a>
            </div>
        @endforeach
    </div>

@endsection
