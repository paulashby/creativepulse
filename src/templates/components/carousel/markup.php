<div class="carousel">
  <div class="carousel-slider">
    <div class="carousel-slider__set">
      <?php foreach ($slides as $slide): ?>
        <div class="carousel-slide">
          <img src="<?= $slide->url() ?>" alt="<?= $slide->description ?>">
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="carousel-controls">
    <div class="directions">
      <button class="carousel__bttn carousel__bttn--prev" data-action="prev"><span class="button__text button__text--hidden">Prev</span></button>
      <button class="carousel__bttn carousel__bttn--next" data-action="next"><span class="button__text button__text--hidden">Next</span></button>
    </div>
  </div>
</div>
