

function init() {
  // This is a static node list - test what happens when there's more that one - we may need to do each individually using an id

  const carouselElmt = document.querySelector(".carousel");
  const slider = carouselElmt.querySelector(".carousel-slider");
  const slideSet = slider.querySelector(".carousel-slider__set");
  const slideCount = slideSet.children.length;

  const state = {
    hasTransformed: false,
    currSlide: 0,
    adjustment: 0
  };
  
  const updateState = () => {
    state.slideW = slideSet.children[0].offsetWidth;
    state.slideSetW = state.slideW * slideCount;
    state.slideVW = state.slideW / window.innerWidth * 100;
    state.slideSetVW = state.slideSetW / window.innerWidth * 100;
  };

  updateState();
  
  // Double up slides to allow scrolling
  const slideSetClone = slideSet.cloneNode(true);
  slider.append(slideSetClone);
  
  const carouselControls = carouselElmt.querySelector(".carousel-controls");
  
  let debounce = false;

  carouselControls.addEventListener("click", (e) => {
    updateSlider(e);
  });

  window.addEventListener("resize", () => {

    if (!debounce) {
      updateState();
      updateSlider();

      debounce = true;
      setTimeout(() => debounce = false, 250);
    }
  });

  const updateSlider = (e = false) => {

    if (e) {
      const action = e.target.dataset.action;
      const adjustment = action === "prev" ? 1 : -1;

      if (Math.abs(state.currSlide) % slideCount === 0) {
        // Don't adjust before first transform
        if (adjustment === 1 || state.hasTransformed) {
          state.currSlide -= adjustment * slideCount;
          resetSliderPosition();          
        }
        state.hasTransformed = true;
      }
      
      state.currSlide += adjustment;
      slider.style.transform = `translateX(${(state.currSlide * state.slideVW)}vw)`;
    } else {
      resetSliderPosition();
    }
  };

  // Position slider so slides can seamlessly loop
  const resetSliderPosition = () => {
    slider.classList.add("transition-off");
    slider.style.transform = `translateX(${(state.currSlide * state.slideVW)}vw)`;
    slider.offsetHeight; // Trigger layout to perform translation with transtion disabled
    slider.classList.remove("transition-off");
  }
}

export const carousel = {
  init: init
}
