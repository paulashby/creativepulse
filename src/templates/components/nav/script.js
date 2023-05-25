const init = () => {
    const submenu = document.querySelector(".nav__submenu");
    const toggle = submenu.querySelector(".nav__submenu-toggle");

    toggle.addEventListener("click", () => {
        submenu.classList.toggle("active");
    });
};

export const nav = {
    init: init
}