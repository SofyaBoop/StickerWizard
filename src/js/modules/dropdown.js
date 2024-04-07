export function initDropdown() {
    const navbarToggleBtn = document.querySelector('.navbar__toggle_btn');
    const dropdownNavbar = document.querySelector('.dropdown_navbar');
    const overlay = document.getElementById('overlay');

    function toggleDropdown() {
        dropdownNavbar.classList.toggle('dropdown_navbar_active');
        overlay.style.display = dropdownNavbar.classList.contains('dropdown_navbar_active') ? 'block' : 'none';
    }

    navbarToggleBtn.addEventListener('click', toggleDropdown);

    const dropdownToggleBtn = document.querySelector('.dropdown_navbar__toggle_btn');

    dropdownToggleBtn.addEventListener('click', function() {
        dropdownNavbar.classList.remove('dropdown_navbar_active');
        overlay.style.display = 'none';
    });
}
  