<div class="modal" id="ajaxTestDesciplineModal">
    <form class="modal-form" id="testDisciplineForm">
        <div class="modal__head">
            <svg class="modal__exit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                <path d="M0 0h24v24H0z" fill="none"/>
            </svg>
            <h3 class="modal-title">Додати контроль</h3>
        </div>
        <div class="modal__body">
            <div class="modal-control" id = 'study_type'>
                <label class="modal-control__label" for="study_type_id">Форма контролю</label>
                <div class="custom-select">
                    <select name="study_type_id">
                        @foreach($currentStudyTypes as $currentStudyType)
                            <option value="{{$currentStudyType->id}}">{{$currentStudyType->study_type_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-control-group">
                <div class="modal-control">
                    <label class="modal-control__label" for="study_type_description">№ контролю</label>
                    <input class="modal-control__input" type="text" name="study_type_description" id="study_type_description">
                </div>
                <div class="modal-control">
                    <label class="modal-control__label" for="max_score">Оцінка</label>
                    <input class="modal-control__input" type="text" name="max_score" id="max_score" required>
                </div>
            </div>


            <div class="modal-control" id = 'study_subtype'>
                <label class="modal-control__label" for="study_sub_type_id">Етапи роботи</label>
                <div class="custom-select">
                    <select name="study_sub_type_id">
                    </select>
                </div>
            </div>

            <div class="modal-control">
                <div class="radio-field radio-field_modal">
                    <label class="radio-btn">
                        <input class="radio-btn__input" type="radio" name="attestation_id" value="1" checked>
                        <span class="radio-btn__box"></span>
                        <span class="radio-btn__label">А1</span>
                    </label>
                    <label class="radio-btn">
                        <input class="radio-btn__input" type="radio" name="attestation_id" value="2">
                        <span class="radio-btn__box"></span>
                        <span class="radio-btn__label">А2</span>
                    </label>
                    <label class="radio-btn">
                        <input class="radio-btn__input" type="radio" name="attestation_id" value="3">
                        <span class="radio-btn__box"></span>
                        <span class="radio-btn__label">Інше</span>
                    </label>
                </div>
            </div>
            <input type="hidden" name="wnp_discipline_sem_id" value="{{$wnpDiscSemEmployer->wnpDisciplineSem->id}}">
            <input type="hidden" id="is_current_study_types" value="{{$currentStudyTypes->isEmpty()}}">

            <div class="error"></div>
            <div class="modal-control-group modal-control-group_centered">
                <div class="modal-control">
                    <button class="modal__btn modal__btn_submit" type="submit" id="btnSaveTestDiscipline">Зберегти</button>
                </div>
                <div class="modal-control">
                    <button class="modal__btn" type="button" id="btnCopyTestDiscipline">Скопіювати</button>
                </div>
            </div>
        </div>
    </form>
</div>



