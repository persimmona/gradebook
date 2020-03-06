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

