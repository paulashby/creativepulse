let contentElmt;
let titleElmt;
let bgElmt;
let inversionBp;
let getAdjustment;
let adjustment = 0;
let occlusionBp;
let isOccludingBgElmt = false;
let prevScrollPosition;
let isInverted;

const init = (options) => {
    contentElmt = document.querySelector(".content-sticky-wrapper");

    if (contentElmt === null) {
        console.info("Content sticky wrapper not found on page.");
        return;
    }

    titleElmt = document.querySelector(".title-sticky__block");

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
    isInverted = clientWidth >= inversionBp;
    getAdjustment = options.adjustmentFnc;
    prevScrollPosition = window.scrollY;
    
    window.addEventListener("debouncedResize", () => {
        setContentStickyHeight(document.documentElement.clientWidth);
        updateOcclusion(document.documentElement.clientWidth);

        if (!isOccludingBgElmt) {
            titleElmt.style.opacity = 1;
        }
    });

    window.addEventListener("scroll", () => {
        const currScrollPosition = window.scrollY;

        if (isOccludingBgElmt) {
            // Sticky title will obscure bottom row when scrolled, so fade it out
            const scrollingUp = prevScrollPosition > currScrollPosition;
            let currOpacity = titleElmt.style.opacity;
            currOpacity = currOpacity === "" ? 1 : parseFloat(currOpacity);

            if ( (scrollingUp && currOpacity < 1) || (!scrollingUp && currOpacity > 0) ) {
                const titleHeight = titleElmt.offsetHeight;
                titleElmt.style.opacity = (titleHeight - currScrollPosition) / titleHeight;                
            } 
        }
        prevScrollPosition = currScrollPosition;    
    }, {passive: true});

    updateOcclusion(clientWidth);
    setContentStickyHeight(clientWidth);
}

const updateOcclusion = (clientWidth) => {
    // If bg element will be occluded, title block should fade on scroll
    const clientHeight = document.documentElement.clientHeight;

    // No fade needed if inverted as title scrolls out of the way
    isOccludingBgElmt = !isInverted && clientWidth > occlusionBp && clientHeight < bgElmt.getBoundingClientRect().bottom;
}

const setContentStickyHeight = (clientWidth) => {
    const naturalHeight = contentElmt.offsetHeight - adjustment;
    isInverted = clientWidth >= inversionBp;

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
