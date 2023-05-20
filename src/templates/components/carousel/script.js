const sliderState = {
  offset: 0,
  direction: 1
};
const SCROLL_PERIOD = 5000;
const SCROLL_RESUMES = true;

let activeDot = 0;
let carouselElmt;
let slider;
let slideSet;
let slideSetClone;
let slideCount;
let carouselControls;
let indicatorDots;
let autoscroll;
let debounce = false;

const init = () => {
  carouselElmt = document.querySelector(".carousel");
  slider = carouselElmt.querySelector(".carousel-slider");
  slideSet = slider.querySelector(".carousel-slider__set");
  slideSetClone = slideSet.cloneNode(true);
  slideCount = slideSet.children.length;
  carouselControls = carouselElmt.querySelector(".carousel-controls");

  makeIndicatorDots();
  indicatorDots = carouselControls.querySelectorAll(".indicator");

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
    noScrollFunc(updateSlider, [e]);
  });

  slider.append(slideSetClone);

  updateState();
  startScrolling();
}

const makeIndicatorDots = () => {
  const indicators = document.createElement("div");
  indicators.classList.add("indicators");

  for (let i = 0; i < slideCount; i++) {
    const indicator = document.createElement("button");
    const indicatorSpan = document.createElement("span");
    const indicatorClass = i === 0 ? "indicator indicator--active" : "indicator";

    indicator.setAttribute("content", `Slide  ${i}`);
    indicator.className = indicatorClass;
    indicator.dataset.action = `${i}`;

    indicatorSpan.classList.add("screen-reader-text");
    indicatorSpan.textContent = `Slide ${i}`;

    indicator.appendChild(indicatorSpan);
    indicators.appendChild(indicator);
  }
  carouselControls.appendChild(indicators);
}

const updateState = () => {
  sliderState.slideW = slideSet.children[0].offsetWidth;
  sliderState.slideSetW = sliderState.slideW * slideCount;
  sliderState.slideVW = sliderState.slideW / window.innerWidth * 100;
  sliderState.slideSetVW = sliderState.slideSetW / window.innerWidth * 100;
};

const updateSlider = (e = false) => {
  if (e) {
    const action = e.target.dataset.action;

    if (isNaN(action)) {
      const direction = action === "prev" ? 1 : -1;
      scrollSlider(direction);
    } else {
      // indicator dot click
      goToSlide(parseInt(action, 10));

      indicatorDots.forEach((indicator, i) => {
        if (indicator === e.target) {
          activeDot = i;
          indicator.className = "indicator indicator--active";
        } else {
          indicator.className = "indicator";
        }
      });
    }
  } else {
    // Window resize
    resetSliderPosition();
  }
};

const clampDotNum = (n) => {
  if (n < 0) return slideCount - 1;
  if (n >= slideCount) return 0;
  return n;
}

const updateIndicators = (direction) => {
  if (direction === 1) {
    activeDot = clampDotNum(activeDot - 1);
  } else {
    activeDot = clampDotNum(activeDot + 1);
  }

  indicatorDots.forEach((indicator, i) => {
    indicator.className = i === activeDot ? "indicator indicator--active" : "indicator";
  });
};

const noScrollFunc = (func, argsArr) => {
  // Pause autoscrolling while calling function
  clearInterval(autoscroll);

  func.apply(this, argsArr);

  if (SCROLL_RESUMES) {
    startScrolling();
  }
}

const goToSlide = (slideNum) => {
  /*
    when the slider moves right, offsets are incremented from 0
    when the slider moves left, offsets are decremented from slideCount.
    This means that for slide n, the slider's translation is always n * slideWidth * -1
  */
  const offset = Math.abs(sliderState.offset);
  const currSlide = offset === slideCount ? 0 : offset;
  slider.style.transform = `translateX(${(slideNum * sliderState.slideVW * -1)}vw)`;
  sliderState.offset = slideNum === 0 ? 0 : slideNum * -1;
  sliderState.direction = 1;
};

const startScrolling = () => {
  autoscroll = setInterval(() => {
    scrollSlider(-1);
  }, SCROLL_PERIOD);
};

const scrollSlider = (direction) => {
  // Reposition slider for looping if all slides have been viewed
  if (Math.abs(sliderState.offset) % slideCount === 0) {
    // No need to reposition slider when changing direction
    if (direction === sliderState.direction) {
      sliderState.offset -= direction * slideCount;
      resetSliderPosition();
    }
  }
  sliderState.offset += direction;

  // Store direction so we can check for direction changes
  sliderState.direction = direction;

  // Show next slide
  slider.style.transform = `translateX(${(sliderState.offset * sliderState.slideVW)}vw)`;
  updateIndicators(direction);
}

// Position slider so slides loop
const resetSliderPosition = () => {
  slider.classList.add("transition-off");
  slider.style.transform = `translateX(${(sliderState.offset * sliderState.slideVW)}vw)`;
  slider.offsetHeight; // Trigger layout to perform translation with transtion disabled
  slider.classList.remove("transition-off");
}

export const carousel = {
  init: init
}
