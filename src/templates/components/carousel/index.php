<?php namespace ProcessWire;

$slides = "";
$indicators = "";
$count = 0;

// Slider is shifted so first slide 'bleeds off'. Reorder slides so left-most slide is last one in the given set.
$left_most_image = $slide_images->pop();
$slide_images->prepend($left_most_image);

foreach ($slide_images as $slide) {
    $slides .= "<div class='carousel-slide'>
        <img src='{$slide->url()}' alt='{$slide->description}'>
    </div>";
    $active = $count === 0 ? "indicator--active" : "";
    $indicators .= "<button content='Slide  $count' class='indicator $active' data-action='$count'><span class='indicator__text'>Slide $count</span></button>";
    $count++;
}

?>


<div class="carousel-slider">
    <div class="carousel-slider__set">
      <?= $slides ?>
    </div>
  </div>
  <div class="carousel-controls">
    <div class="directions">
      <button class="carousel__bttn carousel__bttn--prev" data-action="prev"><span class="button__text button__text--hidden">Prev</span></button>
      <button class="carousel__bttn carousel__bttn--next" data-action="next"><span class="button__text button__text--hidden">Next</span></button>
    </div>
    <div class="indicators">
        <?= $indicators ?>
    </div>
</div>
