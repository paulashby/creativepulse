const init = () => {
    const body = document.querySelector("body");
    const toggle = body.querySelector(".nav__submenu-toggle");

    toggle.addEventListener("click", () => {
        body.classList.toggle("nav-active");
    });

    if (body.classList.contains("home")) {
        // Scroll to projects gallery when 'Projects' link clicked
        const projectsLink = body.querySelector("#nav-link__projects");
        const projectsGallery = body.querySelector("#project-gallery");

        projectsLink.addEventListener("click", (e) => {
            const scrollTarget = projectsGallery;
            scrollTarget.scrollIntoView({behavior: "smooth"});
            e.preventDefault();
        });
    }

};

export const nav = {
    init: init
}