function toggleCategory(icon) {
    let productList = icon.nextElementSibling.nextElementSibling;

    if (productList.style.display === "none" || productList.style.display === "") {
        productList.style.display = "block";
        icon.textContent = "🔽"; // Открыто
    } else {
        productList.style.display = "none";
        icon.textContent = "▶"; // Закрыто
    }
}