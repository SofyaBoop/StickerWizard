export function loadUserArticle(){
window.onload = function() {
    if (!window.location.hash) {
        window.location.hash = "#user_profile";
    }
    setUserActiveLink();
    window.addEventListener('hashchange', setUserActiveLink);
};
}

function setUserActiveLink() {
    const currentHash = window.location.hash;
    const links = document.querySelectorAll('.account_links');

    links.forEach(link => {
        if (link.getAttribute('href') === currentHash) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
}


