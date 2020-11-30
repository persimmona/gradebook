function toggleMobileMenu() {
  let mobileMenu = document.querySelector('.mobile-menu');
  let hamburger  = document.querySelector('.hamburger');
  let dataTitle = document.querySelector('.data-title');

  hamburger.addEventListener('click', () => {
    mobileMenu.classList.toggle('mobile-menu_active');
    dataTitle.classList.toggle('data-title_active');
    hamburger.classList.toggle('hamburger_active');
  });
}
toggleMobileMenu();

function toggleDataOptions() {
  let dataOptions = document.querySelectorAll('.data-options');
  dataOptions.forEach(item => {
    item.addEventListener('click', function() {
      let list = this.lastElementChild;
      if (list.classList.contains('data-options__list_active')) {
        list.classList.remove('data-options__list_active');
        this.style.background = '#6aa889';
      } else {
        list.classList.add('data-options__list_active');
        this.style.background = '#4e6b5c';
      }
    });
  });
}
toggleDataOptions();

function showDisciplines() {

  $(".data-tab__item").on("click", function (e) {
    e.preventDefault();

    let termId = $(this).attr('data-id');
    let studyCard = $(this).attr('data-studyCard');

    console.log($(this));

    let table = document.querySelector('.data'+termId);

    if(table.textContent !==''){
      $(this).find('svg').css('transform', 'rotate(0deg)');
      table.innerHTML= '';
    }else{
      $(this).find('svg').css('transform', 'rotate(90deg)');
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: '/ajaxRequest',
        type: 'post',
        data: {
            "termId": termId,
            "studyCard": studyCard
        },
        success: function (data) {
          table.innerHTML = data;
        },
        error: function (err) {
          console.log(err);
        }
      });
    }
  });
}
showDisciplines();

function storeTestResult(){
  $("input#testResult").on("change", function (e) {
    let testDisciplineId = e.target.parentElement.id;
    let studyCardId = e.target.parentElement.parentElement.id;
    let value = e.target.value;

    let maxScore = e.target.getAttribute('maxscore');
    if(Number(value)&&+value <= +maxScore){
      $(this).css('color', 'black');
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: '/storeTestResult',
        type: 'post',
        data: {
          testDisciplineId: testDisciplineId,
          studyCardId: studyCardId,
          value: value
        },
        success: function (data) {
          //console.log(data);
        },
        error: function (err) {
          console.log(err);
        }
      });

    }
    else if(value==='')
    {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: '/destroyTestResult',
        type: 'delete',
        data: {
          testDisciplineId: testDisciplineId,
          studyCardId: studyCardId,
        },
        success: function (data) {
          //console.log(data);
        },
        error: function (err) {
          console.log(err);
        }
      });
    }
    else {
      $(this).css('color', 'red');
    }

  })
}
storeTestResult();

function customSelect() {
  var x, i, j, selElmnt, a, b, c;
  x = document.getElementsByClassName("custom-select");
  for (i = 0; i < x.length; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];
    a = document.createElement("DIV");
    a.setAttribute("class", "select-selected");
    if( selElmnt.options[selElmnt.selectedIndex]!==undefined){
      a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
      a.setAttribute("study_type_id", selElmnt.options[selElmnt.selectedIndex].value);
    }
    x[i].appendChild(a);
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");//
    for (j = 0; j < selElmnt.length; j++) {
      c = document.createElement("DIV");
      c.innerHTML = selElmnt.options[j].innerHTML;
      c.addEventListener("click", function(e) {
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            h.setAttribute('study_type_id', s.options[i].value);
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
    x[i].appendChild(b);
    a.addEventListener("click", function(e) {
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
  }


  function closeAllSelect(elmnt) {
    var x, y, i, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    for (i = 0; i < y.length; i++) {
      if (elmnt == y[i]) {
        arrNo.push(i)
      } else {
        y[i].classList.remove("select-arrow-active");
      }
    }
    for (i = 0; i < x.length; i++) {
      if (arrNo.indexOf(i)) {
        x[i].classList.add("select-hide");
      }
    }
  }
  document.addEventListener("click", closeAllSelect);
}
customSelect();



function createModal() {

  $('.data-add__button').click(function (e) {
    $("input[name='wnpDisciplineSemId']").val($(this).attr('data-wnpDisciplineSem'));
    $("input[name='employerId']").val($(this).attr('data-employerId'));
    // let name = $('#employer_select').find('option[value='+$(this).attr('id')+']').text();
    // $('#employer_select').find('option[value='+$(this).attr('id')+']').remove();
    // if(name)
    //   $(".select-items div:contains('" + name + "')").remove();
    // $('.select-selected')[0].textContent = $('#employer_select option:nth-child(1)').text();

    $('#addEditEmpTypeModal').show();
  });
  $('.data-delete__button').click(function (e) {
    $("input[name='wnpDisciplineSemIdExc']").val($(this).attr('data-wnpDisciplineSem'));
    $('#deleteEditEmpTypeModal').show();
  });

  $('#btnCloseEditEmpType').click(function() {
    $('#addEditEmpTypeModal').hide();
  });

  $('#btnCreateStudyType').click(function() {
    $('#ajaxStudyTypeModal').show();
  });

  $('#btnExcepAddStudyType').click(function(e) {
    e.preventDefault();
    $('#exceptionTestDisciplineModal').hide();
    $('#ajaxStudyTypeModal').show();
  });

  $('.journal__add').click(function() {
    $("#study_type .select-selected").eq(0).removeClass("none");
    $("#study_type_description").prop("disabled", false);
    $("#study_type .custom-select").eq(0).css("pointer-events", "all");
    $("#btnUpdateTestDiscipline").replaceWith('<button class="modal__btn modal__btn_submit" type="submit" id="btnSaveTestDiscipline">Зберегти</button>');
    $("#btnDeleteTestDiscipline").replaceWith('<button class="modal__btn" type="button" id="btnCopyTestDiscipline">Скопіювати</button>');
    $('#ajaxTestDesciplineModal').show();
  });




  $('.modal__exit').click(function() {
    $('.modal').hide();
    $('.modal-form').trigger("reset");
    $('.error').empty();
  });
  
  $('.modal__btn_close').click(function() {
    $('.modal_small').hide();
  });

  window.onclick = function(event) {
    if ($(event.target).is('.modal_small')) {
      $('.modal_small').hide();
      $('#copyForm').trigger("reset");
    }
      else if($(event.target).is('.modal')){
      $('.modal').hide();
      $('.modal-form').trigger("reset");
      $('.error').empty();
    }
  }
}
createModal();

function storeTestDiscipline(){
  $('#testDisciplineForm').submit(function (e){
    e.preventDefault();
    $('.error').empty();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "/disciplines",
      type: "post",
      data: $('#testDisciplineForm').serialize(),
      success: function (data) {
        if ($.isEmptyObject(data.error)) {
          $('#ajaxTestDesciplineModal').hide();
          $('#testDisciplineForm').trigger("reset");
          location.reload();
        } else {
          $('.error').append('<p>' + data.error + '</p>');
        }
      },
    });
  });
}

storeTestDiscipline();

function copyTestDiscipline() {
  let data;
  $('#btnCopyTestDiscipline').click(function(e) {
    e.preventDefault();
    $('.error').empty()
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "/disciplines",
      type: "post",
      data: data=$('#testDisciplineForm').serialize(),
      success: function (data) {
        if ($.isEmptyObject(data.error)) {
          $('.error').append('<p>Збережено</p>').css('color','green');
          $('#copyTestDisciplineModal').show();
        } else {
          $('.error').append('<p>' + data.error + '</p>');
        }
      },
    });
  });
  $('#btnSaveCopyTestDiscipline').click(function(e) {
    e.preventDefault();
    let copyNum = $('#copy_num').val();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "/disciplines-copy",
      type: "post",
      data: $('#testDisciplineForm').serialize()+ '&copyNum=' + copyNum,
      success: function (data) {
        if ($.isEmptyObject(data.error)) {
          $('#copyTestDisciplineModal').hide();
          $('#copyForm').trigger("reset");
          $('#ajaxTestDesciplineModal').hide();
          $('#testDisciplineForm').trigger("reset");
          location.reload();
        } else {
          $('#copyTestDisciplineModal').hide();
          $('.error').append('<p>' + data.error + '</p>');
        }
      },
    });
  });
}
copyTestDiscipline();

function editTestDiscipline() {
  $(document).on('click','.journal__edit-button',function(e) {
    e.preventDefault();
    let testDiscId = $(this).attr("id");
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "/disciplines/"+testDiscId+"/edit",
      type: "get",
      success: function (data) {
        $("#study_type_description").val(data.study_type_description);
        $("#study_type_description").prop("disabled", true);

        $("#max_score").val(data.max_score);

        $("#study_type .select-selected")[0].textContent =data.study_type_name;
        $("#study_type .select-selected").eq(0).attr('study_type_id', data.study_type_id );
        $("#study_type .custom-select").eq(0).css("pointer-events", "none");
        $("#study_type .select-selected").eq(0).addClass("none");

        $("#study_subtype .select-selected")[0].textContent = data.study_sub_type_name;
        $("#study_subtype select").html(data.study_sub_types);
        let b = $("#study_subtype .select-items")[0];
        b.innerHTML = "";
        let s = document.getElementsByName('study_sub_type_id')[0];
        makeSelectItems(s,b);

        $(".radio-field input[value='"+data.attestation_id+"']").prop("checked", true);
        $("#btnSaveTestDiscipline").replaceWith('<button class="modal__btn modal__btn_submit" type="button" ' +
            'id="btnUpdateTestDiscipline" data-test_disc_id = '+testDiscId+'>Оновити</button>');
        $("#btnCopyTestDiscipline").replaceWith('<button class="modal__btn" type="button" ' +
            'id="btnDeleteTestDiscipline" data-test_disc_id ='+testDiscId+'>Видалити</button>');
        $('#ajaxTestDesciplineModal').show();
      },
    });
  });

}
editTestDiscipline();

function updateTestDiscipline() {
  $(document).on('click','#btnUpdateTestDiscipline', function(e){
    e.preventDefault();
    let testDiscId = $(this).attr("data-test_disc_id");
    $('.error').empty();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "/disciplines/"+testDiscId,
      type: "post",
      data: $('#testDisciplineForm').serialize(),
      success: function (data) {
        if ($.isEmptyObject(data.error)) {
          $('#ajaxTestDesciplineModal').hide();
          // $('#testDisciplineForm').trigger("reset");
          location.reload();
        } else {
          $('.error').append('<p>' + data.error + '</p>');
        }
      },
    });
  });
}

updateTestDiscipline();

function deleteTestDiscipline() {
  $(document).on('click','#btnDeleteTestDiscipline', function(e){
    let testDiscId = $(this).attr("data-test_disc_id");
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "/disciplines/"+testDiscId,
      type: "delete",
      success: function (data) {
          $('#ajaxTestDesciplineModal').hide();
          // $('#testDisciplineForm').trigger("reset");
          location.reload();
      },
    });
  });
}

deleteTestDiscipline();


function groupAccordion() {
  var acc = document.getElementsByClassName("group-accordion__btn");
  var i;

  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
      this.classList.toggle("active");
      $(this).children().eq(2).css('display', 'block');
      $(this).children().eq(1).css('display', 'none');
      let panel = $(this).parent().next();
      console.log(panel.css('max-height') != 0);
      if (panel.css('max-height') != '0px') {
        panel.css('max-height', 0);
        $(this).children().eq(1).css('display', 'block');
        $(this).children().eq(2).css('display', 'none');
      } else {
        if ($(this).attr("data-students-count")!=0) {

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          $.ajax({
            url: "group-list/students",
            type: "post",
            data: {
              groupId: $(this).attr("data-group-id")
            },
            success: function (data) {
              let info = `<table class="data data_zebra"><tr>
                    <th>Прізвище</th>
                    <th>Ім'я</th>
                    <th>По-батькові</th>
                </tr>`;
              data.forEach(studnet => {
                info += `<tr>
                    <td>`+studnet['last_name']+`</td>
                    <td>`+studnet['first_name']+`</td>
                    <td>`+studnet['middle_name']+`</td>
                </tr>`;
              });
              info +=`</table>`;
              panel.html(info);
              panel.css('max-height', panel.prop('scrollHeight'));
            },
          });
        } else {
          panel.html('<p>Немає записів</p>')
          panel.css('max-height', panel.prop('scrollHeight'));
        }
      }
    });
  }
}

groupAccordion();


function btnExportHandler() {
  $('#groupCheckFrom').submit(function (event) {
    let groupToExport = $('.check-btn__input:checked');
    if(groupToExport.length==0) {
      $('#choseGroupModal').show();
      event.preventDefault();
    }
  });

  $('body').on('click', '#choseGroupModal .modal__btn_submit', function () {
    $('#choseGroupModal').hide();
  });

}
btnExportHandler();
