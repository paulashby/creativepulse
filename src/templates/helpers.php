<?php namespace Processwire;

/** @var Page $component */

// Render component of the given type in wrapper div with class based on given width
function renderComponent($options) {
    // Set defaults for unstyled components (those that are not derived from project repeater)
    $align_h = ""; 
    $align_v = "";
    $text_color = "";
    $id_string = "";

    if (array_key_exists("styled", $options)) {
        $component = $options["component"];
        $id = $component->id;
        $id_string = "id='component_$id'";
        $type = $component->component_type->name;
        $width = $type === "carousel" ? "page-width" : $component->component_width->name;
        $text_color = $component->reverse_text === 1 ? "component--rev" : "";
        $align_h = "component--h-" . $component->alignment_horizontal->name;
        $align_v = "component--v-" . $component->alignment_vertical->name;
    } else {
        $type = $options["type"];
        $width = $options["width"];
    }

    $class_list = "$type component component--$width $align_h $align_v $text_color";
    
    $component_inner = wire("files")->render("components/$type/index.php", $options);
    return "<div $id_string class='$class_list'>
        $component_inner
    </div>";
}

function getLazyImageMarkup($image, $image_options) {
    $sizes = [
        "page-width" => "100vw",
        "content-width" => "(min-width: 750px) 80vw, 100vw",
        "content-half-width" => "(min-width: 1200px) 563px, (min-width: 760px) 40vw, (min-width: 560px) 50vw, 100vw",
        "text-width" => "(min-width: 1260px) 731px, (min-width: 1040px) calc(69.5vw - 131px), (min-width: 760px) 80vw, 100vw"
    ];

    $dsc = $image->description;
    $alt_str = $dsc ? $dsc : "Example of our work for {$page->title}";
    $image_options["alt_str"] = $alt_str;
    $image_options["image"] = $image;
    $image_options["sizes"] = $sizes[$image_options["size_key"]];
    $lazyImages = wire("modules")->get("LazyResponsiveImages");

    return $lazyImages->renderImage($image_options);
}