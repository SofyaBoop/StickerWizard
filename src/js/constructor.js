import { initDropdown } from './modules/dropdown.js';
import { previewUploadedImage } from './modules/preview_uploaded_img.js';
import { initializeConstructorBtns } from './modules/construcor_btns.js';
import { initializeConstructorInputs } from './modules/constructor_inputs.js';
import { initCalculator } from './modules/constructor_calc_price.js';
import { activeHeaderLink } from './modules/active_link_header.js';

document.addEventListener('DOMContentLoaded', function() {
    activeHeaderLink();
    initDropdown();
    //previewUploadedImage();
    initializeConstructorBtns();
    initializeConstructorInputs();
    initCalculator();
});