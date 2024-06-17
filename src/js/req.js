import { initDropdown } from './modules/dropdown.js';
import { changeLoginSigninForms } from './modules/change_login_signin_forms.js';
import { activeHeaderLink } from './modules/active_link_header.js';
document.addEventListener('DOMContentLoaded', function() {
    activeHeaderLink();
    initDropdown();
    changeLoginSigninForms();    
});