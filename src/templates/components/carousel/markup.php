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
    <button class="carousel-prev" data-action="prev">Prev</button>
    <button class="carousel-next" data-action="next">Next</button>
  </div>
</div>