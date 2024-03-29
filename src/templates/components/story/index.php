<?php namespace ProcessWire;

$heading = $component->heading;
$text = $component->text;
$images_out = getImageMarkup($component->image, "content-half-width", "images");
$img_class = $images_out ? "has_image" : "";

?>

<div class="gs_reveal component-content">
    <div class="type-block">
        <h2 class="subheading"><?= $heading ?></h2>
        <div class="text">
            <?= $text ?>
        </div>
    </div>
    <?= $images_out ?>
</div>