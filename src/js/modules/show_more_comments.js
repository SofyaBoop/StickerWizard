export function showMoreReviews(){
    const loadMoreBtn = document.getElementById("load_more_btn");
    const reviews = document.querySelectorAll(".testimonial-box");
    let visibleReviews = 2;
    const reviewsToShow = 2;

    // Показываем первые два отзыва при загрузке страницы
    for (let i = 0; i < visibleReviews; i++) {
        if (reviews[i]) {
            reviews[i].style.display = "block";
        }
    }

    function showReviews() {
        for (let i = visibleReviews; i < visibleReviews + reviewsToShow; i++) {
            if (reviews[i]) {
                reviews[i].style.display = "block";
            }
        }
        visibleReviews += reviewsToShow;
        if (visibleReviews >= reviews.length) {
            loadMoreBtn.style.display = "none";
        }
    }

    loadMoreBtn.addEventListener("click", showReviews);
}
