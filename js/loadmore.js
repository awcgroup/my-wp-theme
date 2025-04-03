document.addEventListener("DOMContentLoaded", function () {
    let loadMoreBtn = document.getElementById("load-more");
    let productContainer = document.getElementById("custom-product-list");

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener("click", function () {
            let page = parseInt(loadMoreBtn.getAttribute("data-page")) + 1;
            let category = loadMoreBtn.getAttribute("data-category");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", loadmore_params.ajaxurl, true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    if (xhr.responseText.trim() === "end") {
                        loadMoreBtn.style.display = "none";
                    } else {
                        productContainer.insertAdjacentHTML("beforeend", xhr.responseText);
                        loadMoreBtn.setAttribute("data-page", page);
                    }
                }
            };

            xhr.send("action=load_more_products&page=" + page + "&category=" + category);
        });
    }
});