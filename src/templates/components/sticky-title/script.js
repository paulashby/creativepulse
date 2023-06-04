let contentElmt;
let titleElmt;
let bgElmt;
let inversionBp;
let getAdjustment;
let adjustment = 0;
let occlusionBp;
let isOccludingBgElmt = false;
let prevScrollPosition;

const init = (options) => {
    contentElmt = document.querySelector(".content-sticky-wrapper");

    if (contentElmt === null) {
        console.info("Content sticky wrapper not found on page.");
        return;
    }

    titleElmt = document.querySelector(".sticky-title__block");

    if (titleElmt === null) {
        console.info("Sticky title block not found on page.");
        return;
    }

    const clientWidth = document.documentElement.clientWidth;
    bgElmt = document.querySelector(options.bgElmtSelector);
    occlusionBp = options.occlusionBreakpoint;

    /*
        At widths > inversionBp, the stickiness is reversed,
        with the title panel scrolling and the other page 
        elements remaining in place.
        
        In this case, the value of the adjustment variable
        determines the distance the page can be scrolled 
        before the stickiness is 'released'.
     */
    inversionBp = options.inversionBreakpoint;
    getAdjustment = options.adjustmentFnc;
    prevScrollPosition = window.scrollY;
    
    window.addEventListener("debouncedResize", () => {
        updateOcclusion(document.documentElement.clientWidth);
        setContentStickyHeight(document.documentElement.clientWidth, contentElmt.offsetHeight - adjustment);
    });

    window.addEventListener("scroll", () => {
        const currScrollPosition = window.scrollY;

        if (isOccludingBgElmt) {
            // Sticky title will obscure bottom row when scrolled, so fade it out
            const scrollingUp = prevScrollPosition > currScrollPosition;
            let currOpacity = titleElmt.style.opacity;
            currOpacity = currOpacity === "" ? 1 : parseFloat(currOpacity);

            if (scrollingUp) {
                if (currOpacity < 1) {
                    titleElmt.style.opacity = currOpacity + 0.1;
                }
            } else if (currOpacity > 0) {
                titleElmt.style.opacity = currOpacity - 0.1;
            }
        }
        prevScrollPosition = currScrollPosition;    
    }, {passive: true});

    updateOcclusion(clientWidth);
    setContentStickyHeight(clientWidth, contentElmt.offsetHeight - adjustment);
}

const updateOcclusion = (clientWidth) => {
    // If bg element will be occluded, title block should fade on scroll
    const clientHeight = document.documentElement.clientHeight;
    isOccludingBgElmt = clientWidth > occlusionBp && clientHeight < bgElmt.getBoundingClientRect().bottom;
}

const setContentStickyHeight = (clientWidth, naturalHeight) => {
    
    const isInverted = clientWidth >= inversionBp;

    if (isInverted) {
        adjustment = getAdjustment(clientWidth);
        contentElmt.style.height = `${naturalHeight + adjustment}px`;
    } else {
        adjustment = 0;
        contentElmt.style.height = `${naturalHeight}px`;
    }
}

export const stickyTitle = {
    init: init
}
