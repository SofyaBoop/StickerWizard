export function activeLinksSidebar(){
    var currentUrl = window.location.href;
    var pageUrl = currentUrl.replace(/\/[^\/]+\.php$/, '');
    var menuLinks = document.querySelectorAll('.sidebar_link');

    menuLinks.forEach(function(link) {
        var linkHref = link.getAttribute('href').replace(/\/[^\/]+\.php$/, '').toLowerCase();
        
        if (linkHref === pageUrl) {
            link.classList.add('active');
        }
    });
}
   