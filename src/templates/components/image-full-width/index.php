<?php
namespace ProcessWire;

$images = $component->image_full_width;

$img_options = [
    "class" => "",
    "field_name" => "image_full_width",
    "sizes" => "100vw",
    "lazy_load" => true,
    "webp" => true
];

?>

<div class="gs_reveal component-content">
    <?php foreach ($images as $image) {
        $dsc = $image->description;
        $img_options["alt_str"] = $dsc ? $dsc : "Example of our work for {$page->title}";
        $img_options["image"] = $image;

        echo getLazyImageMarkup($img_options);
    } ?>
</div>