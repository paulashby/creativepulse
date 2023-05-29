<?php namespace ProcessWire;

$slides = "";
$indicators = "";
$count = 0;

foreach ($slide_images as $slide) {
    $slides .= "<div class='carousel-slide'>
        <img src='{$slide->url()}' alt='{$slide->description}'>
    </div>";
    $active = $count === 0 ? "indicator--active" : "";
    $indicators .= "<button content='Slide  $count' class='indicator $active' data-action='$count'><span class='indicator__text'>Slide $count</span></button>";
    $count++;
}

?>

<div class="carousel">
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
</div>
