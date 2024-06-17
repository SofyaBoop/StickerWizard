import { activeLinksSidebar } from "./modules/admin_sidebar";
import { showImageModal, clearImageSrc} from "./modules/admin_show_service_img";
document.addEventListener('DOMContentLoaded', function() {
    activeLinksSidebar();  

    document.querySelectorAll('.btn_link_open_file').forEach(button => {
        button.addEventListener('click', function() {
            showImageModal(this);
        });
    });

    document.querySelector('.x_image_exit').addEventListener('click', function() {
        clearImageSrc();
    });
});
