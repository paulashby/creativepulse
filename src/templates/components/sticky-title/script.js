let contentElmt;
let breakpoint;
let getAdjustment;
let adjustment = 0;

const init = (adjustmentBreakpoint, adjustmentFnc) => {
    contentElmt = document.querySelector(".content-sticky-wrapper");
    breakpoint = adjustmentBreakpoint;
    getAdjustment = adjustmentFnc;

    if (contentElmt === null) {
        console.info("Content sticky wrapper not found on page.");
        return;
    }

    window.addEventListener("debouncedResize", () => {
        setContentStickyHeight();
    });

    setContentStickyHeight();
}


const setContentStickyHeight = () => {
    const clientWidth = document.documentElement.clientWidth;
    const isSticky = clientWidth >= breakpoint;
    const naturalHeight = contentElmt.offsetHeight - adjustment;

    if (isSticky) {
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
