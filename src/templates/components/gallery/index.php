<?php namespace ProcessWire;

define("BLOCK_COUNT", 12);

$gallery_placeholders = $pages->get(1206)->gallery_image;
$img_options = [
    "class" => "gs_reveal_img gallery__image",
    "field_name" => "gallery_image",
    "sizes" => "(min-width: 750px) 33.33vw, 50vw",
    "lazy_load" => true,
    "webp" => true
];

?>

<ul class="gallery__blocks">
    <?php
    foreach ($gallery_placeholders as $image):
        $dsc = $image->description;
        $img_options["alt_str"] = $dsc ? $dsc : "Example of our work for {$page->title}";
        $img_options["image"] = $image;
    ?>
        <li id="block--<?= $i ?>" class="gallery__block">
            <?= getLazyImageMarkup($img_options) ?>
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
    <?php endforeach; ?>
</ul>
