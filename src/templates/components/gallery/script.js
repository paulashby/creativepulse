const activeBlockClass = "gallery__block--active";
let galleryBlocksElmt;

const init = (config) => {

    galleryBlocksElmt = document.querySelector(".gallery__blocks");

    if (galleryBlocksElmt === null) {
        console.info("Gallery blocks element not found on page.");
        return;
    }
}

export const gallery = {
    init: init
}