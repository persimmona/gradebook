require('./bootstrap');

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