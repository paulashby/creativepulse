<?php
namespace ProcessWire;

$images = $component->image;

$img_options = [
    "class" => "",
    "field_name" => "image",
    "size_key" => $component->component_width->name,
    "lazy_load" => true,
    "webp" => true,
];

?>

<div class="gs_reveal component-content">
    <?php foreach ($images as $image) {
        echo getLazyImageMarkup($image, $img_options);
    } ?>
</div>