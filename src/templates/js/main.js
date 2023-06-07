import { nav } from "../components/nav/script";
import { footer } from "../components/footer/script";
import { gallery } from "../components/gallery/script";
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
    gallery.init({
        /* 
        Button config - each key represents min viewport width and each tuple 
        represents a "hide button" range for the corresponding block's button.
        The unit used for ranges is scrollY expressed in block heights.
        -1 represents no hiding required.

        This approach combined with gallery/getBttnToggles allows us to avoid 
        using collision detection for the same task
        */
        0: [[-1, -1], [-1, -1], [1, 2], [1, 2], [1, 3], [1, 3], [2, 4], [2, 4], [3, 5], [3, 5], [4, 6], [4, 6]],
        750: [[-1, -1], [-1, -1], [-1, -1], [-1, -1], [1, 2], [1, 2], [-1, -1], [1, 2], [1, 2], [-1, -1], [-1, -1], [-1, -1]],
        1200: [[-1, -1], [-1, -1], [-1, -1], [-1, -1], [-1, -1], [1, 2], [1, 2], [-1, -1], [-1, -1], [1, 2], [1, 2], [-1, -1]],
        1600: [[-1, -1], [-1, -1], [1, 2], [1, 2], [-1, -1], [-1, -1], [-1, -1], [-1, -1], [-1, -1], [-1, -1], [-1, -1], [-1, -1]],
    });
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
