const activeBlockClass = "gallery__block--active";
let galleryBlocksElmt;

const init = (config) => {

    galleryBlocksElmt = document.querySelector(".gallery__blocks");

    if (galleryBlocksElmt === null) {
        console.info("Gallery blocks element not found on page.");
        return;
    }

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