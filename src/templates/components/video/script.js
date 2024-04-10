const videos = {};

const init = () => {
    // window.addEventListener("load", () => {
    //     setPosterImages();
    // });
    setPosterImages();

    window.addEventListener("debouncedResize", () => {
        setPosterImages();
    });
}

const initVideo = (video) => {
    videos[video.id] = video.posterUrls;
}

const setPosterImages = () => {
    const urlKey = getUrlKey(window.innerWidth);
    for (const [key, value] of Object.entries(videos)) {
        const videoElmt = document.querySelector(`#${key}`);
        videoElmt.setAttribute("poster", value[urlKey]);
    }
}

const getUrlKey = (screenWidth) => {
    if (screenWidth >= 1200) {
        return "1200";
    }
    if (screenWidth >= 1040) {
        return "1040";
    }
    if (screenWidth >= 660) {
        return "660";
    }
    return "0";
}

export const video = {
    init,
    initVideo
}
