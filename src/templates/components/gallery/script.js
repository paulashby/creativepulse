const activeBlockClass = "gallery__block--active";
let galleryBlocksElmt;
let blocks;
let scrolledBlockCount = 0;
let bttnConfig;
let bttnBreakpoints;
let bttnToggles;
let clientWidth = document.documentElement.clientWidth;

const init = (config) => {

    galleryBlocksElmt = document.querySelector(".gallery__blocks");

    if (galleryBlocksElmt === null) {
        console.info("Gallery blocks element not found on page.");
        return;
    }

    /*
    Object.keys returns non-negative integer keys in ascending order by value.
    We'll loop through this in reverse to find the numeric breakpoint string
    to use as a key when accessing the button toggle data in bttnConfig
    */
    bttnBreakpoints = Object.keys(config);
    bttnConfig = config;
    bttnToggles = getBttnToggles(clientWidth);

    blocks = galleryBlocksElmt.children;
    scrolledBlockCount = getScrolledBlockCount(blocks[0].offsetWidth);

    window.addEventListener("debouncedResize", () => {
        clientWidth = document.documentElement.clientWidth;
        bttnToggles = getBttnToggles(clientWidth);
    });

    window.addEventListener("scroll", () => {
        const scrollY = window.scrollY;
        scrolledBlockCount = getScrolledBlockCount(scrollY, blocks[0].offsetWidth);
        setButtonVisibility(scrolledBlockCount);
    }, {passive: true});

    galleryBlocksElmt.addEventListener("click", (e) => {
        if (e.target.classList.contains("bttn-icon")) {
            const targetBlock = e.target.closest(".gallery__block");

            for (let block of blocks) {
                if (block === targetBlock) {
                    block.classList.toggle(activeBlockClass);
                } else {
                    block.classList.remove(activeBlockClass);
                }
            }
        }
    });
}

const getScrolledBlockCount = (scrollY, blockIncrement) => {
    return Math.ceil( scrollY / blockIncrement);
}

const setButtonVisibility = (scroll) => {
    bttnToggles.forEach((show, i) => {
        const occluded = scroll >= show[0] && scroll < show[1];
        const classList = blocks[i].classList;
        if (occluded) {
            classList.add("occluded");
            classList.remove(activeBlockClass);
        } else {
            classList.remove("occluded");
        }
    });
}

// Return array of button toggle settings from bttnConfig
const getBttnToggles = (clientWidth) => {
    for (let i = bttnBreakpoints.length - 1; i >= 0; i--) {
        const breakpoint = bttnBreakpoints[i];

        if (clientWidth >= breakpoint) {
            return bttnConfig[breakpoint];
        }
    }
    throw new Error(`Breakpoint not provided for width of ${clientWidth}`);
}

export const gallery = {
    init: init
}