const activeBlockClass = "gallery__block--active";
let galleryBlocksElmt;
let blocks;
let scrolledBlockCount = 0;
let clientWidth = document.documentElement.clientWidth;

const init = (config) => {

    galleryBlocksElmt = document.querySelector(".gallery__blocks");

    if (galleryBlocksElmt === null) {
        console.info("Gallery blocks element not found on page.");
        return;
    }

    blocks = galleryBlocksElmt.children;
    scrolledBlockCount = getScrolledBlockCount(blocks[0].offsetWidth);

    window.addEventListener("debouncedResize", () => {
        clientWidth = document.documentElement.clientWidth;
    });

    window.addEventListener("scroll", () => {
        const scrollY = window.scrollY;
        scrolledBlockCount = getScrolledBlockCount(scrollY, blocks[0].offsetWidth);
    }, {passive: true});

    galleryBlocksElmt.addEventListener("click", (e) => {
        // Show info for active gallery item
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

    // Animate gallery images
    gsap.utils.toArray(".gs_reveal_img").forEach(function (elem) {

        ScrollTrigger.create({
            trigger: elem,
            start: "0 300px",
            onEnter: function () { animateGalleryImage(elem)
            },
            once: true
        });
    });
}

const getScrolledBlockCount = (scrollY, blockIncrement) => {
    return Math.ceil( scrollY / blockIncrement);
}

const animateGalleryImage = (elem) => {

    gsap.fromTo(elem, { scale: 1.2}, {
        duration: 1,
        scale: 1,
        ease: "power2",
        overwrite: "auto"
    });
}

export const gallery = {
    init: init
}