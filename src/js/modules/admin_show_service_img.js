export function showImageModal(button) {
    var imageSrc = button.getAttribute('data-image');
    var modal = document.getElementById('imageModal'); 
    var modalImage = document.getElementById('modalImage');
    
    modalImage.src = imageSrc;
    modal.showModal();

    console.log(imageSrc);
}

export function clearImageSrc() {
    var modalImage = document.getElementById('modalImage');
    modalImage.src = '';

    console.log(modalImage.src);
}




