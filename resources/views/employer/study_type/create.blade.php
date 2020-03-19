<div class="modal" id="ajaxStudyTypeModal">
<form class="modal-form" id="studyTypeForm">
    <div class="modal__head">
        <svg id="exit" class="modal__exit" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
            <path d="M0 0h24v24H0z" fill="none"/>
        </svg>
        <h3 class="modal-title">Додати форму контролю</h3>
    </div>
    <div class="modal__body">
        <div class="modal-control">
            <label class="modal-control__label" for="">Повна назва</label>
            <input class="modal-control__input" type="text" name="study_type_name" id="" placeholder="Лабораторна робота" autocomplete="off" required>
        </div>

        <div class="modal-control">
            <label class="modal-control__label" for="">Скорочена форма</label>
            <input class="modal-control__input" type="text" name="study_type_short_name" id="" placeholder="ЛР" autocomplete="off" required>
        </div>

        <div class="modal-control">
            <label class="modal-control__label" for="">Тип викладача</label>
            <div class="custom-select" name="" id="">
                <select name = "edit_emp_type_id">
                    @foreach(\App\Models\EmpType::all() as $empType)
                    <option value="{{$empType->id}}">{{$empType->emp_type_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="error"></div>

        <div class="modal-control-group modal-control-group_centered">
            <div class="modal-control">
                <button class="modal__btn modal__btn_submit" id="btnSaveStudyType" type="submit">Зберегти</button>
            </div>
            <div class="modal-control">
                <button class="modal__btn" type="button" id="btnAddStudyType">Додати ще</button>
            </div>
        </div>
    </div>
</form>
</div>