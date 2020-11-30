@extends("layout")

@section("title", "Викладач — Журнал Оцінок")

@section('content')
    <h1 class="data-title">{{$currentData->sessionType->semester_type_name}} семестр {{$currentData->current_study_year_id}} навчального року</h1>
    <div class="root__overflow-container">
        <div class="root__data-container">
            <a href="{{route('group-list.index', [auth()->user()->division->id])}}" class="btn btn-link">Перелік груп</a>
            <table class="data data_zebra">
                <tr>
                    <th>Поточні предмети</th>
                    <th>Група</th>
                    <th>Головний викладач</th>
                    <th>Асистенти</th>
                </tr>
                @foreach($wnpDisciplineSems as $wnpDisciplineSem)
                    <tr>

                        <td><a href="{{route('discipline.showJournal', ['wnpDisciplineSem'=>$wnpDisciplineSem, 'slug'=>
                    Str::slug( $wnpDisciplineSem->discipline->discipline_name)])}}">{{$wnpDisciplineSem->discipline->discipline_name}}</a></td>
                        <td>{{ $wnpDisciplineSem->wnpSemester->wnpTitle->studyGroup->study_group_name}}</td>
                        <td><ul class='data-add__list'>
                                <li class = 'data-add__item'><? echo isset($wnpDisciplineSem->getEmpType1()->employer) ?
                                    $wnpDisciplineSem->getEmpType1()->employer->last_name.' '.$wnpDisciplineSem->getEmpType1()->employer->short_name : ''?>
                                <li class='data-add__item'>
                                    <div class="data__button data-add__button" data-wnpDisciplineSem="{{$wnpDisciplineSem->id}}" data-employerId="1">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16pt" height="24pt" viewBox="0 0 24 24" version="1.1">
                                            <g id="surface1557200">
                                                <path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,100%,100%);fill-opacity:1;" d="M 18 2 L 15.585938 4.414062 L 19.585938 8.414062 L 22 6 Z M 14.074219 5.921875 L 3 17 L 3 21 L 7 21 L 18.078125 9.925781 Z M 14.074219 5.921875 "/>
                                            </g>
                                        </svg>


                                    </div>
                                </li>
                            </ul>
                        </td>
                        <td>
                            <ul class = 'data-add__list'>
                                @foreach($wnpDisciplineSem->getEmpType2() as $empl)
                                <li class = 'data-add__item'>{{$empl->employer->last_name}} {{$empl->employer->short_name}}
                                @endforeach
                                <li class = 'data-add__item'>
                                    <div class="data__button data-add__button" data-wnpDisciplineSem="{{$wnpDisciplineSem->id}}" data-employerId="2">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                 width="26" height="26"
                                                 viewBox="0 0 172 172"
                                                 style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#ffffff"><path d="M79.12,30.96v48.16h-48.16v13.76h48.16v48.16h13.76v-48.16h48.16v-13.76h-48.16v-48.16z"></path></g></g></svg>
                                    </div>
                                    @if(!$wnpDisciplineSem->getEmpType2()->isEmpty())
                                    <div class="data__button data-delete__button" data-wnpDisciplineSem="{{$wnpDisciplineSem->id}}" data-employerId="2">
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                             width="24" height="24"
                                             viewBox="0 0 172 172"
                                             style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g id="original-icon" fill="#ffffff"><path d="M21.5,78.83333v14.33333h129v-14.33333z"></path></g></g></svg>
                                    </div>
                                    @endif
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>


    <div class="modal" id="addEditEmpTypeModal">
        <form class="modal-form" id="addEditEmpTypeForm" action="division-editemp" method="post">
            @csrf
            <div class="modal__head">
                <svg class="modal__exit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    <path d="M0 0h24v24H0z" fill="none"/>
                </svg>
                <h3 class="modal-title">Назначити викладача</h3>
            </div>
            <div class="modal__body">
                <div class="modal-control" id = 'employer'>
                    <label class="modal-control__label" for="employer_id">Оберіть викладача</label>
                    <div class="custom-select">
                        <select name="employer_id" id='employer_select'>
                            @foreach($employers as $employer)
                                <option value="{{$employer->id}}">{{$employer->last_name}} {{$employer->short_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="hidden" name="wnpDisciplineSemId" value="">
                <input type="hidden" name="employerId" value="">
                <div class="modal-control-group modal-control-group_centered">
                    <div class="modal-control">
                        <button class="modal__btn modal__btn_submit" type="submit" id="btnSaveEditEmpType">Зберегти</button>
                    </div>
                    <div class="modal-control">
                        <button class="modal__btn modal__btn_close" type="button" id="btnCloseEditEmpType">Закрити</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal_small" id="deleteEditEmpTypeModal">
        <form class="modal-form" id="deleteEditEmpTypeForm" action="/division-editemp-delete" method="post">
            @method('DELETE')
            @csrf
            <div class="modal__body">
                <div class="modal-control">
                    <div class="modal-notification">
                        <div class="modal-notification__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 24 24">
                                <circle cx="12" cy="19" r="2"/><path d="M10 3h4v12h-4z"/>
                                <path d="M0 0h24v24H0z" fill="none"/>
                            </svg>
                        </div>
                        <p class="modal-notification__text">Ви впевнені, що бажаєте видалити запис?</p>
                    </div>
                </div>
                <input type="hidden" name="wnpDisciplineSemIdExc" value="">
                <div class="modal-control-group modal-control-group_centered modal-control-group_nospace">
                    <div class="modal-control">
                        <button class="modal__btn modal__btn_submit" type="submit">
                            Так
                        </button>
                    </div>
                    <div class="modal-control">
                        <button class="modal__btn modal__btn_close" type="button">Ні</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="{{asset('js/app.js')}}" defer></script>
@endsection
