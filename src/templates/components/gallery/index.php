<?php namespace ProcessWire;

define("BLOCK_COUNT", 12);

?>

<ul class="gallery__blocks">
    <?php for ($i = 0; $i < BLOCK_COUNT; $i++) : ?>
        <li id="block--<?= $i ?>" class="gallery__block">
            <div class="gallery__image"></div>
            <button class="bttn-icon bttn-icon--info-on"><span class="bttn__text bttn__text--hidden">More information</span></button> 
            <div class="gallery__info">
                <button class="bttn-icon bttn-icon--info-off"><span class="bttn__text bttn__text--hidden">Close</span></button>
                <div class="gallery__info-content">
                    <p class="gallery__info-description">
                        Visually unravelling the complex world of automation networks
                    </p>
                    <button class="bttn-cp bttn-cp--case"><span class="bttn__text">View case study</span></button>
                </div>
            </div>        
        </li>
    <?php endfor; ?>
</ul>
