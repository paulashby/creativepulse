let contentElmt;
let bgElmt;
let inversionBp;
let getAdjustment;
let adjustment = 0;
let occlusionBp;
let isOccludingBgElmt = false;

const init = (options) => {
    contentElmt = document.querySelector(".content-sticky-wrapper");

    if (contentElmt === null) {
        console.info("Content sticky wrapper not found on page.");
        return;
    }

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

    window.addEventListener("debouncedResize", () => {
        const clientWidth = document.documentElement.clientWidth;
        const naturalHeight = contentElmt.offsetHeight - adjustment;

        updateOcclusion(clientWidth);
        setContentStickyHeight(clientWidth, naturalHeight);
    });
    
    updateOcclusion(document.documentElement.clientWidth);
    setContentStickyHeight();
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
