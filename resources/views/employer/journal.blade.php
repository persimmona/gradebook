@extends("layout")

@section("title", "Викладач — Журнал Оцінок")

@section('content')
<?
$testDisciplines = $wnpDisciplineSem->testDisciplines;
$division = auth()->user()->division;
$currentStudyTypes = \App\Models\StudyType::get();
$empType = $wnpDisciplineSem->getEmpTypeByEmployerId(auth()->user()->id);
?>
<h1 class="data-title">{{$currentData->sessionType->semester_type_name}} семестр {{$currentData->current_study_year_id}} навчального року</h1>
<p class="data-subtitle">{{ $wnpDisciplineSem->discipline->discipline_name}}</p>
<p class="data-subtitle">{{ $wnpDisciplineSem->wnpSemester->wnpTitle->studyGroup->study_group_name}}</p>

<button type="button" class="btn" onclick="printJS({
		printable: 'grade-table',
		type: 'html',
		css: '{{ asset('css/app.css') }}',
        style: '.journal th { padding: 2px;} .journal th span { writing-mode: vertical-rl;}'
        })">
    Роздрукувати таблицю
</button>
{{--@if(auth()->user()->postition_id != 565)--}}
{{--<button id="btnCreateStudyType" class="btn">Додати форму контролю</button>--}}
{{--@endif--}}
<p class="data-text">
  @foreach($testDisciplines->unique('study_type_id') as $testDiscipline)
    @if(isset($testDiscipline->studyType))
      {{$testDiscipline->studyType->study_type_name}} &#8211; {{$testDiscipline->max_score}}&emsp;
    @endif
  @endforeach
</p>
<div class="root__overflow-container">
    <div class="root__data-container" >


        <table class="journal" id="grade-table">
          <tr>
                <td class="journal__corner">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <line x1="0" y1="0" x2="100%" y2="100%" stroke="#e8e8e8" stroke-width="2"/>
                    </svg>
                    <span class="journal__col-title">Контроль</span>
                    <span class="journal__row-title">Прізвище, <br> ім'я студента</span>
                </td>
                @foreach(\App\Models\TestDiscipline::getA1($testDisciplines) as $testDiscipline)
                <th>
                    @if($empType == 0)
                        <span>{{$testDiscipline->studyType->study_type_short_name}} {{$testDiscipline->study_type_description}}
                            {{is_null($testDiscipline->studySubtype)? '':$testDiscipline->studySubtype->study_subtype_short_name}}</span>
                    @elseif(isset($testDiscipline->studyType->edit_emp_type_id))
                        @if($empType != 1)
                            <span>{{$testDiscipline->studyType->study_type_short_name}} {{$testDiscipline->study_type_description}}
                                {{is_null($testDiscipline->studySubtype)? '':$testDiscipline->studySubtype->study_subtype_short_name}}</span>
                        @else
                            <button class = "journal__edit-button" id="{{$testDiscipline->id}}"><span>{{$testDiscipline->studyType->study_type_short_name}} {{$testDiscipline->study_type_description}}
                                    {{is_null($testDiscipline->studySubtype)? '':$testDiscipline->studySubtype->study_subtype_short_name}}</span></button>
                        @endif
                    @else
                        <button class = "journal__edit-button" id="{{$testDiscipline->id}}"><span>{{$testDiscipline->studyType->study_type_short_name}} {{$testDiscipline->study_type_description}}
                                {{is_null($testDiscipline->studySubtype)? '':$testDiscipline->studySubtype->study_subtype_short_name}}</span></button>
                    @endif
                </th>
                @endforeach
                <th class="journal__expression"><span>Атестація 1</span></th>
                @foreach(\App\Models\TestDiscipline::getA2($testDisciplines) as $testDiscipline)
                    <th>
                        @if($empType == 0)
                            <span>{{$testDiscipline->studyType->study_type_short_name}} {{$testDiscipline->study_type_description}}</span>
                        @elseif(isset($testDiscipline->studyType->edit_emp_type_id))
                            @if($empType != 1)
                                <span>{{$testDiscipline->studyType->study_type_short_name}} {{$testDiscipline->study_type_description}}</span>
                            @else
                                <button class = "journal__edit-button" id="{{$testDiscipline->id}}"><span>{{$testDiscipline->studyType->study_type_short_name}}
                                        {{$testDiscipline->study_type_description}}</span></button>
                            @endif
                        @else
                            <button class = "journal__edit-button" id="{{$testDiscipline->id}}"><span>{{$testDiscipline->studyType->study_type_short_name}}
                                    {{$testDiscipline->study_type_description}}</span></button>
                        @endif
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
            @foreach( $wnpDisciplineSem->wnpSemester->wnpTitle->studyGroup->studyCards()->orderByStudLastName() as $studyCard)
            <tr id="{{$studyCard->id}}">
                <td>{{$studyCard->student->last_name}} {{$studyCard->student->first_name}}</td>

                @foreach(\App\Models\TestDiscipline::getA1($testDisciplines) as $testDiscipline)

                <td id="{{$testDiscipline->id}}"><input type=text name=testResult id=testResult value="<? $testResult = \App\Models\TestResult::getByStudyCardId($studyCard, $testDiscipline);
                    echo isset($testResult) ? $testResult->value : '' ?>" <? if(isset($testDiscipline->studyType->edit_emp_type_id))
                        echo $empType == 1? '':'disabled' ; elseif($empType==0) echo 'disabled'?> maxscore = {{$testDiscipline->max_score}}>
                </td>

                @endforeach

                <td class="journal__expression">{{\App\Models\TestDiscipline::sumTestResultsA1ByStudyCardId($testDisciplines, $studyCard->id)}} </td>

                @foreach(\App\Models\TestDiscipline::getA2($testDisciplines) as $testDiscipline)
                    <td id="{{$testDiscipline->id}}"><input type=text name=testResult id=testResult value="<? $testResult = \App\Models\TestResult::getByStudyCardId($studyCard, $testDiscipline);
                        echo isset($testResult) ? $testResult->value : '' ?>" <? if(isset($testDiscipline->studyType->edit_emp_type_id))
                            echo $empType == 1? '':'disabled' ; elseif($empType==0) echo 'disabled'?> maxscore = {{$testDiscipline->max_score}}>
                    </td>

                @endforeach

                <td class="journal__expression">{{\App\Models\TestDiscipline::sumTestResultsA2ByStudyCardId($testDisciplines, $studyCard->id)}}</td>

                @foreach(\App\Models\TestDiscipline::getA3($testDisciplines) as $testDiscipline)
                <td  id="{{$testDiscipline->id}}">
                    <input type=text name=testResult id=testResult value="<? $testResult =
                        \App\Models\TestResult::getByStudyCardId($studyCard, $testDiscipline);
                    echo isset($testResult) ? $testResult->value : '' ?>" <? if(isset($testDiscipline->studyType->edit_emp_type_id))
                        echo $empType == 1? '':'disabled'; elseif($empType==0) echo 'disabled'?> maxscore = {{$testDiscipline->max_score}}>
                </td>
                @endforeach

                <td class="journal__expression">{{\App\Models\TestDiscipline::sumTestResultsByStudyCardId($testDisciplines, $studyCard->id)}}</td>
            </tr>
            @endforeach
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


{{--@include('employer.study_type.create')--}}
@include('employer.modals.create')
@include('employer.modals.copy')
@include('employer.modals.exception')

<script>
    function customSelectForStudySubtype(){
        let x, s, study_type_id, study_subtype, a, b;
        s = document.getElementById("study_type").
        getElementsByClassName("select-selected")[0];//div select-selected
        x = document.getElementById("study_subtype");
        study_subtype = document.getElementsByName('study_sub_type_id')[0];//select
        a = x.getElementsByClassName("select-selected")[0];//div select-selected
        b = x.getElementsByClassName("select-items")[0];//div

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/disciplines-study-subtype",
            type: "post",
            data: {'study_type_id':s.getAttribute('study_type_id')},
            success: function (data) {
                study_subtype.innerHTML = data;
                a.innerHTML = study_subtype.options[study_subtype.selectedIndex].innerHTML;
                b.innerHTML = "";
                study_subtype.innerHTML = data;
                makeSelectItems(study_subtype, b);
            },
        });
        $(s).on('click',function () {
            if(!$(s).hasClass('select-arrow-active')){
                study_type_id = s.getAttribute('study_type_id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/disciplines-study-subtype",
                    type: "post",
                    data: {'study_type_id':study_type_id},
                    success: function (data) {
                        b.innerHTML = "";
                        study_subtype.innerHTML = data;
                        makeSelectItems(study_subtype, b);
                    },
                });
            }
        });

    }
    function makeSelectItems(study_subtype,b) {
        for (let j = 0; j < study_subtype.length; j++) {
            let c = document.createElement("DIV");
            c.innerHTML = study_subtype.options[j].innerHTML;
            c.addEventListener("click", function() {
                let y, i, k, s, h;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                h = this.parentNode.previousSibling;
                for (i = 0; i < s.length; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;
                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        for (k = 0; k < y.length; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");
                        break;
                    }
                }
                h.click();
            });
            b.appendChild(c);
        }
    }
    $(document).ready(function() {
        customSelectForStudySubtype();
    });
</script>

<script src="{{ asset('js/app.js')}}" defer></script>

@endsection
