import { nav } from "../components/nav/script";
import { footer } from "../components/footer/script";
import { stickyTitle } from "../components/sticky-title/script";
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
    stickyTitle.init({
        inversionBreakpoint: 1600, 
        occlusionBreakpoint: 750, 
        bgElmtSelector: "#block--8",
        adjustmentFnc: (clientWidth) => {
            return clientWidth/6;
        }
    });
    carousel.init();
});
