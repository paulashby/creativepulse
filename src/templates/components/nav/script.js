const init = () => {
    const body = document.querySelector("body");
    const toggle = body.querySelector(".nav__submenu-toggle");

    toggle.addEventListener("click", () => {
        body.classList.toggle("nav-active");
    });
};

export const nav = {
    init: init
}