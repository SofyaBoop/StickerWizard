export function initDetails() {
    const detailsElements = document.querySelectorAll('details');
    
    detailsElements.forEach(details => {
        details.addEventListener('click', () => {
            detailsElements.forEach(item => (item !== details && item.open) && item.removeAttribute('open'));
        });
    });
}