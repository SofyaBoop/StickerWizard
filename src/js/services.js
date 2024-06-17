import { initDropdown } from './modules/dropdown.js';
import { showMoreReviews } from './modules/show_more_comments.js';
import { activeHeaderLink } from './modules/active_link_header.js';

document.addEventListener('DOMContentLoaded', function() {
    activeHeaderLink();
    initDropdown();
    showMoreReviews();
});