document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".subcategory-toggle").forEach(function (toggle) {
        toggle.addEventListener("click", function () {
            let sublist = this.parentElement.querySelector(".subcategory-list");
            if (sublist) {
                sublist.style.display = (sublist.style.display === "block") ? "none" : "block";
                this.textContent = (sublist.style.display === "block") ? "▲" : "▼"; // Меняем + на -
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    let desc = document.querySelector(".term-description");
    if (!desc) return; // Выходим, если элемента нет

    let button = document.createElement("span");
    button.className = "show-more-btn";
    button.innerText = "Показать больше";
    desc.after(button);

    button.addEventListener("click", function () {
        desc.classList.toggle("expanded");
        button.innerText = desc.classList.contains("expanded") ? "Скрыть" : "Показать больше";
    });
});