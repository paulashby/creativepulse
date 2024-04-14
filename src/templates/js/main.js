import { nav } from "../components/nav/script";
import { footer } from "../components/footer/script";
import LazyLoad from './vendor/lazyload.esm.min';

let lazyLoad = new LazyLoad({
  elements_selector: ".lazy",
  threshold: 150,
  cancel_on_exit: true
});

const debouncedResizeEvent = new Event("debouncedResize");
const body = document.querySelector("body");
const reveal_offset = 100;

let debounce;

window.addEventListener("DOMContentLoaded", (event) => {

    window.addEventListener("resize", () => {

        clearTimeout(debounce);
        body.classList.add("resizing");

        debounce = setTimeout(() => {
            body.classList.remove("resizing", "nav-active");

            window.dispatchEvent(debouncedResizeEvent);
        }, 250);
    });

    gsap.registerPlugin(ScrollTrigger);
    nav.init();
    footer.init();

    const body = document.querySelector("body");
    if (body.classList.contains("home")) {
        initModule("gallery");
    } else if (body.classList.contains("project")) {
        dynamicImports.forEach(moduleName => {
            initModule(moduleName);
        })
    }

    // Scroll to projects gallery when 'Projects' link clicked
    const projectsLink = body.querySelectorAll(".link__projects");
    const projectsGallery = body.querySelector("#project-gallery");

    projectsLink.forEach(link => {
        link.addEventListener('click', (e) => {
            const scrollTarget = projectsGallery;
            scrollTarget.scrollIntoView({behavior: "smooth"});
            e.preventDefault();
        });
    });

    // Animate components into position
    gsap.utils.toArray(".gs_reveal").forEach(elem => {
        gsap.set(elem, {y:reveal_offset, visibility:"visible"});

        ScrollTrigger.create({
            trigger: elem, onEnter: function () { animateFrom(elem, elem.classList.contains("gs_padding")) }
        });
    });

    gsap.utils.toArray(".gs_reveal_block").forEach(elem => {

        ScrollTrigger.create({
            trigger: elem,
            onEnter: function () {
                animateGalleryImage(elem)
            },
            once: true
        });
    });

    const animateGalleryImage = (elem) => {

        gsap.fromTo(elem, { scale: 0.9 }, {
            duration: 1,
            scale: 1,
            ease: "power1.out",
            overwrite: "auto"
        });
    }
});

const initModule = async (moduleName) => {
    const initFunctions = {
        carousel: (importedModule) => {
            /* One carousel per project, so no need to select all instances */
            importedModule.init()
        },
        gallery: (importedModule) => {
            /* One gallery per page, so no need to select all instances */
            importedModule.init()
        },
        video: (importedModule) => {
            const videoComponents = document.querySelectorAll(".video");

            videoComponents.forEach(videoComponent => {
                const videoElmt = videoComponent.querySelector("video");
                /* Poster image has been provided - pass variation urls to imported module's initVideo function so correct variation can be used */
                if (videoElmt.hasAttribute("data-poster")) {
                    const options = {
                        id: videoComponent.getAttribute("id"),
                        posterUrls: {
                            "0": videoElmt.dataset["poster-0"],
                            "660": videoElmt.dataset["poster-660"],
                            "1040": videoElmt.dataset["poster-1040"],
                            "1200": videoElmt.dataset["poster-1200"]
                        }
                    }
                    importedModule.initVideo(options);
                }
            });
            importedModule.init();
        }
    };

    const initFunc = initFunctions[moduleName];

    if (initFunc) {
        const importedModule = await import(`./../components/${moduleName}/script`);
        initFunc.call(this, importedModule[moduleName]);
    }
}

const animateFrom = (elem, animatePadding) => {

    let x = 0,
        y = reveal_offset,
        tweenFrom = { x: x, y: y},
        tweenTo = {
            duration: 2.5,
            x: 0,
            y: 0,
            ease: "expo",
            overwrite: "auto"
        };

    if (animatePadding) {
        let padding_end = gsap.getProperty(elem, "paddingBottom");

        tweenFrom.paddingBottom = padding_end + 200;
        tweenTo.paddingBottom = padding_end;
    }
    gsap.fromTo(elem, tweenFrom, tweenTo);
}
