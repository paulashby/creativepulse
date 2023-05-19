const state = {
  currSlide: 0,
  direction: 1
};

let carouselElmt;
let slider;
let slideSet;
let slideSetClone;
let slideCount;
let carouselControls;
let debounce = false;

const init = () => {
  carouselElmt = document.querySelector(".carousel");
  slider = carouselElmt.querySelector(".carousel-slider");
  slideSet = slider.querySelector(".carousel-slider__set");
  slideSetClone = slideSet.cloneNode(true);
  slideCount = slideSet.children.length;
  carouselControls = carouselElmt.querySelector(".carousel-controls");
  
  window.addEventListener("resize", () => {
    if (!debounce) {
      // Store new widths
      updateState();

      // Use new widths
      updateSlider();

      debounce = true;
      setTimeout(() => debounce = false, 250);
    }
  });

  carouselControls.addEventListener("click", (e) => {
    updateSlider(e);
  });

  slider.append(slideSetClone);

  updateState();
}

const updateState = () => {
  state.slideW = slideSet.children[0].offsetWidth;
  state.slideSetW = state.slideW * slideCount;
  state.slideVW = state.slideW / window.innerWidth * 100;
  state.slideSetVW = state.slideSetW / window.innerWidth * 100;
};

const updateSlider = (e = false) => {
  if (e) {
    const action = e.target.dataset.action;
    const direction = action === "prev" ? 1 : -1;

    if (Math.abs(state.currSlide) % slideCount === 0) {
      // Don't reset when changing direction
      if (direction === state.direction) {
        state.currSlide -= direction * slideCount;
        resetSliderPosition();          
      }
    }
    state.currSlide += direction;
    state.direction = direction;
    slider.style.transform = `translateX(${(state.currSlide * state.slideVW)}vw)`;
  } else {
    // Window resize
    resetSliderPosition();
  }
};

// Position slider so slides loop
const resetSliderPosition = () => {
  slider.classList.add("transition-off");
  slider.style.transform = `translateX(${(state.currSlide * state.slideVW)}vw)`;
  slider.offsetHeight; // Trigger layout to perform translation with transtion disabled
  slider.classList.remove("transition-off");
}

export const carousel = {
  init: init
}
