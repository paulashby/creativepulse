import { nav } from "../components/nav/script";
import { footer } from "../components/footer/script";
import { carousel } from "../components/carousel/script";

const debouncedResizeEvent = new Event("debouncedResize");
const body = document.querySelector("body");

let debounce;

window.addEventListener("DOMContentLoaded", (event) => {

    window.addEventListener("resize", () => {   

        clearTimeout(debounce);
        body.classList.add("resizing");
        
        debounce = setTimeout(() => {            
           body.classList.remove("resizing");
           window.dispatchEvent(debouncedResizeEvent);
        }, 250);
    });

    nav.init();
    carousel.init();
});
