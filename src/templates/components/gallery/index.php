<?php namespace ProcessWire;

define("BLOCK_COUNT", 12);

?>

<section class="gallery">
    <ul class="gallery__blocks">
        <?php for ($i = 0; $i < BLOCK_COUNT; $i++) : ?>
            <li id="block--<?= $i ?>" class="gallery__block">
                <div class="gallery__image"></div>
                <div class="gallery__info">
                    <p class="gallery__info-description">
                        Visually unravelling the complex world of automation networks
                    </p>
                    <button class="gallery__info-bttn"><span class="button__text">View case study</span></button>
                </div>        
            </li>
        <?php endfor; ?>
    </ul>
</section>