import { initDropdown } from './modules/dropdown.js';
import { activeHeaderLink } from './modules/active_link_header.js';
document.addEventListener('DOMContentLoaded', function() {
    activeHeaderLink();
    initDropdown();
});