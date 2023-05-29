<?php namespace ProcessWire;

// Ultimately we'll include a gallery_image
// PageArray will be passed in via $content var

$elements = [];

for ($i = 0; $i < 12; $i++) {
    // active class will be set by click
    // $active_status = $i !== 3 ? "" : "gallery__info--active";
    $elements[] = "<li class='gallery__block'>
        <div class='gallery__image'></div>
        <div class='gallery__info $active_status'>
            <p class='gallery__info-description'>
                Visually unravelling the complex world of automation networks
            </p>
            <button class='gallery__info-bttn'><span class='button__text'>View case study</span></button>
        </div>
        
    </li>";
}

?>

<section class="gallery">
    <ul class="gallery__blocks">
        <?= implode($elements) ?>
    </ul>
</section>