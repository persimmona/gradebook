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
    let svg = document.querySelector('.forward-icon');

    let termId = $(this).attr('data-id');

    let table = document.querySelector('.data'+termId);

    if(table.textContent !==''){
      svg.style.transform = 'rotate(0deg)';
      table.innerHTML= '';
    }else{
      svg.style.transform = 'rotate(90deg)';
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: '/ajaxRequest',
        type: 'post',
        data: { "termId": termId },
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
    if( selElmnt.options[selElmnt.selectedIndex]!==undefined)
      a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    x[i].appendChild(a);
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");
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


  $('#btnCreateStudyType').click(function() {
    $('#ajaxStudyTypeModal').show();
  });

  $('#btnExcepAddStudyType').click(function(e) {
    e.preventDefault();
    $('#exceptionTestDisciplineModal').hide();
    $('#ajaxStudyTypeModal').show();
  });

  $('.journal__add').click(function() {
    if($('#is_current_study_types').val()){

      $('#exceptionTestDisciplineModal').show();
    }else{
      $('#ajaxTestDesciplineModal').show();
    }

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

function storeStudyType() {
  $('#studyTypeForm').submit(function (e){
  e.preventDefault();
  $('.error').empty();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url: "/study-types",
    type: "post",
    data: $('#studyTypeForm').serialize(),
    success: function (data) {
      if ($.isEmptyObject(data.error)) {
        $('#ajaxStudyTypeModal').hide();
        $('#studyTypeForm').trigger("reset");
        location.reload();
      } else {
        $('.error').append('<p>' + data.error + '</p>');
      }
    },
  });
  });
}

storeStudyType();



function storeAndCreateStudyType() {
  $('#btnAddStudyType').click(function(e) {
    e.preventDefault();
    $('.error').empty();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "/study-types",
      type: "post",
      data: $('#studyTypeForm').serialize(),
      success: function (data) {
        if ($.isEmptyObject(data.error)) {
          $('#studyTypeForm').trigger("reset");
          location.reload();
        } else {
          $('.error').append('<p>' + data.error + '</p>');
        }
      },
    });
  });
}
storeAndCreateStudyType();

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
copyTestDiscipline()

