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
$i = 0;
?>

<ul class="gallery__blocks">
    <?php
    foreach ($gallery_placeholders as $image):
        $dsc = $image->description;
        $img_options["alt_str"] = $dsc ? $dsc : "Example of our work for {$page->title}";
        $img_options["image"] = $image;
    ?>
        <li id="block--<?= $i ?>" class="gallery__block">
            <a href="/projects/volvic/">
                <?= getLazyImageMarkup($img_options) ?>
                <div class="gallery__info">
                    <div class="gallery__info-content">
                        <p class="gallery__info-description">
                            Our work for Danone Waters helped Volvic make a splash in the marketplace.
                        </p>
                    </div>
                </div>
            </a>
        </li>
    <?php
    $i++;
    endforeach; ?>
</ul>
