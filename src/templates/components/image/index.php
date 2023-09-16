<?php
namespace ProcessWire;

$image_sizes = [
    "page-width" => "100vw",
    "content-width" => "(min-width: 750px) 80vw, 100vw",
    "content-half-width" => "(min-width: 1200px) 563px, (min-width: 760px) 40vw, (min-width: 560px) 50vw, 100vw",
    "text-width" => "(min-width: 1260px) 731px, (min-width: 1040px) calc(69.5vw - 131px), (min-width: 760px) 80vw, 100vw"
];

$images = $component->image;

$img_options = [
    "class" => "",
    "field_name" => "image",
    "sizes" => $image_sizes[$component->component_width->name],
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