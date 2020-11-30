@extends("layout")

@section("title", "Викладач — Журнал Оцінок")

@section('content')
    <h1 class="data-title">Перелік груп</h1>
    <div class="root__overflow-container">
        <div class="root__data-container">
            <form action="group-list/toexel" method="post" id="groupCheckFrom">
                @csrf
                @foreach($groupInfos as $groupInfo)
                    <div class="group-accordion">

                        <div class="group-accordion-wrap">
                            <label class="check-btn">
                                <input class="check-btn__input" type="checkbox" name="groups[]" value="{{$groupInfo['id']}}">
                                <span class="check-btn__box"></span>
                            </label>
                            <div class="group-accordion__btn" data-group-id = "{{$groupInfo['id']}}" data-students-count="{{$groupInfo['study_group_students_count']}}">
                                <div class="accordion-text"><span class="accordion-text__group">{{$groupInfo['study_group_name']}}</span>
                                    ({{$groupInfo['study_group_students_count']}} студентів)</div>
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                     width="30" height="30"
                                     viewBox="0 0 30 30"
                                     style=" fill:#000000;"><path d="M 14.984375 0.98632812 A 1.0001 1.0001 0 0 0 14 2 L 14 25.585938 L 10.707031 22.292969 A 1.0001 1.0001 0 0 0 9.9902344 21.990234 A 1.0001 1.0001 0 0 0 9.2929688 23.707031 L 14.205078 28.619141 A 1.0001 1.0001 0 0 0 15.792969 28.623047 A 1.0001 1.0001 0 0 0 15.796875 28.617188 L 20.707031 23.707031 A 1.0001 1.0001 0 1 0 19.292969 22.292969 L 16 25.585938 L 16 2 A 1.0001 1.0001 0 0 0 14.984375 0.98632812 z"></path></svg>
                                <svg
                                        xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                        width="30" height="30"
                                        viewBox="0 0 30 30"
                                        style=" fill:#000000;"><path d="M 14.984375 0.98632812 A 1.0001 1.0001 0 0 0 14.207031 1.3769531 A 1.0001 1.0001 0 0 0 14.203125 1.3828125 L 9.2929688 6.2929688 A 1.0001 1.0001 0 1 0 10.707031 7.7070312 L 14 4.4140625 L 14 28 A 1.0001 1.0001 0 1 0 16 28 L 16 4.4140625 L 19.292969 7.7070312 A 1.0001 1.0001 0 1 0 20.707031 6.2929688 L 15.791016 1.3769531 A 1.0001 1.0001 0 0 0 14.984375 0.98632812 z"></path></svg>
                            </div>
                        </div>
                        <div class="group-accordion__panel"></div>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-export-exel">Експорт до exel</button>
            </form>


        </div>
    </div>

    <div class="modal_small" id="choseGroupModal">
        <div class="modal-form">
            <div class="modal__body ">
                <div class="modal-control">
                    <div class="modal-notification">
                        <div class="modal-notification__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 24 24">
                                <circle cx="12" cy="19" r="2"/><path d="M10 3h4v12h-4z"/>
                                <path d="M0 0h24v24H0z" fill="none"/>
                            </svg>
                        </div>
                        <p class="modal-notification__text">Оберіть групи для експорту до excel документу</p>
                    </div>
                </div>
                <div class="modal-control-group modal-control-group_centered modal-control-group_nospace">
                    <div class="modal-control">
                        <button class="modal__btn modal__btn_submit" >
                            Добре
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="{{asset('js/app.js')}}" defer></script>
@endsection