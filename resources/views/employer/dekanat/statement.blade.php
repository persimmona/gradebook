@extends("layout")

@section("title", "Викладач — Журнал Оцінок")

@section('content')
    <h1 class="data-title">ДВНЗ "Приазовський державний технічний університет"</h1>
    <p class="data-subtitle">Зведена атестаційна відомість: Атестація №{{$attestation}}, {{$studyYear}} - {{$sessionType}}</p>
    <p class="data-subtitle">Група {{$group->study_group_name}}, семестер {{$semester}}</p>

{{--    <button type="button" class="btn" onclick="printJS({--}}
{{--        printable: 'grade-table',--}}
{{--        type: 'html',--}}
{{--        css: '{{ asset('css/app.css') }}',--}}
{{--        style: '.journal th { padding: 2px;} .journal th span { writing-mode: vertical-rl;}'--}}
{{--        })">--}}
{{--        Роздрукувати таблицю--}}
{{--    </button>--}}
    <div class="root__overflow-container">
        <div class="root__data-container" >
            <table class="journal statement-journal" id="statement-table">
                <tr>
                    <td><span> №</span></td>
                    <td><span>Студент</span></td>
                    @foreach($disciplineTitles as $disciplineTitle)
                        <th><span> {{$disciplineTitle}}</span></th>
                    @endforeach

                </tr>
                @foreach($data as $student => $results)
                    <tr>
                        <td><span>{{$counter++}}</span></td>
                        <td><span>{{$student}}</span></td>
                        @foreach($results as $result)
                            <td><span>{{$result}}</span></td>
                        @endforeach
                    </tr>
                @endforeach
                <tr>
                    <td><span></span></td>
                    <td><span>Максимальна кількість балів</span></td>
                    @foreach($discMaxScores as $result)
                        <td><span>{{$result}}</span></td>
                    @endforeach
                </tr>
                <tr>
                    <td><span></span></td>
                    <td><span>Успішність, %</span></td>
                    @foreach($successfulness as $result)
                        <td><span>{{$result}}</span></td>
                    @endforeach
                </tr>
                <tr>
                    <td><span></span></td>
                    <td><span>Якість, %</span></td>
                    @foreach($nullInfo as $result)
                        <td><span>{{$result}}</span></td>
                    @endforeach
                </tr>
                <tr>
                    <td><span></span></td>
                    <td><span>Кількість атоматів</span></td>
                    @foreach($nullInfo as $result)
                        <td><span>{{$result}}</span></td>
                    @endforeach
                </tr>
                <tr>
                    <td><span></span></td>
                    <td><span>Викладач</span></td>
                    @foreach($mainTeachers as $result)
                        <td><span>{{$result}}</span></td>
                    @endforeach
                </tr>
                <tr>
                    <td><span></span></td>
                    <td><span>Розпис</span></td>
                    @foreach($nullInfo as $result)
                        <td><span>{{$result}}</span></td>
                    @endforeach
                </tr>
            </table>
        </div>
    </div>



    <div class="home-link-container home-link-container_journal">
        <a class="home-link" href="{{ url()->previous() }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                <path class="stroke" fill="#fff" d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"/>
                <path fill="none" d="M0 0h24v24H0z"/>
            </svg>
            Назад
        </a>
    </div>

    <script src="{{ asset('js/app.js')}}" defer></script>

@endsection
