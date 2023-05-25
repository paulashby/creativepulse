import { nav } from "../components/nav/script";
import { footer } from "../components/footer/script";
import { carousel } from "../components/carousel/script";

window.addEventListener("DOMContentLoaded", (event) => {
    nav.init();
    carousel.init();
});
