<?php namespace ProcessWire;

define("BLOCK_COUNT", 12);
$placeholder_image = $pages->get(1050)->gallery_image->first();

?>

<ul class="gallery__blocks">
    <?php for ($i = 0; $i < BLOCK_COUNT; $i++) : ?>
        <li id="block--<?= $i ?>" class="gallery__block">
            <img src="<?= $placeholder_image->url ?>"  alt="<?= $placeholder_image->description ?>" class="gs_reveal_img gallery__image">
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
