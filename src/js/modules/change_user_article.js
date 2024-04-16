const contentLinks = document.querySelectorAll('.content_links');
const contentArticle = document.querySelectorAll('.account_content__article');
let activeLink = null;

function removeActiveClass(elements) {
    elements.forEach(element => element.classList.remove('active'));
}

function setActiveLink(link) {
    contentLinks.forEach(l => l.classList.remove('active'));
    link.classList.add('active');
    activeLink = link;
}

function handleClick(event) {
    event.preventDefault();
    const targetArticleId = this.getAttribute('href').substring(1);
    removeActiveClass(contentArticle);
    setActiveLink(this);

    window.location.hash = targetArticleId;
    window.scrollTo(0, 0);
    document.getElementById(targetArticleId).classList.add('active');
}

function checkHashOnLoad() {
    const hash = window.location.hash.substring(1);
    if (hash) {
        document.getElementById(hash).classList.add('active');
        contentLinks.forEach(link => {
            if (link.getAttribute('href').substring(1) === hash) {
                setActiveLink(link);
            }
        });
    }
}

export function changeArticle() {
    contentLinks.forEach(link => {
        link.addEventListener('click', handleClick);
    });

    window.onload = checkHashOnLoad;
}
