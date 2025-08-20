document.addEventListener("DOMContentLoaded", function () {
    var menuToggle = document.querySelector(".menu-toggle");
    var mainMenu = document.querySelector(".main-menu");

    if (menuToggle && mainMenu) {
        menuToggle.addEventListener("click", function () {
            mainMenu.classList.toggle("show");

            // Accessibility
            var expanded = menuToggle.getAttribute("aria-expanded") === "true" || false;
            menuToggle.setAttribute("aria-expanded", !expanded);
        });
    }
});