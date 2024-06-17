export function activeHeaderLink(){
    var currentPath = window.location.pathname;
        
    console.log("Current Path:", currentPath);

    var currentPage = currentPath.substring(currentPath.lastIndexOf('/') + 1);

    console.log("Current Page:", currentPage);

    var navLinks = document.querySelectorAll('.navbar__links li a');

    navLinks.forEach(function(link) {
        link.parentElement.classList.remove('active');

        var linkPath = link.getAttribute('href');
        var linkPage = linkPath.substring(linkPath.lastIndexOf('/') + 1);

        console.log("Link Path:", linkPath, "Link Page:", linkPage);

        // Проверяем, совпадают ли страницы
        if (linkPage === currentPage) {
            link.classList.add('active');
            console.log("Active link found:", link);
        }
    });
}
