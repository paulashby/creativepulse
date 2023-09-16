import { nav } from "../components/nav/script";
import { footer } from "../components/footer/script";
import { gallery } from "../components/gallery/script";
import { carousel } from "../components/carousel/script"; 
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
    gallery.init();
    carousel.init();

    // Animate components into position
    gsap.utils.toArray(".gs_reveal").forEach(function (elem) {
        gsap.set(elem, {y:reveal_offset, visibility:"visible"});

        ScrollTrigger.create({
            trigger: elem,onEnter: function () { animateFrom(elem, elem.classList.contains("gs_padding")) }
        });
    });
});

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
