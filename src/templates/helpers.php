<?php namespace Processwire;

/** @var Page $component */

// Render component of the given type in wrapper div with class based on given width
function renderComponent($options) {
    $type = $options["type"];
    // Set defaults for unstyled components (those that are not derived from project repeater)
    $align_h = "";
    $align_v = "";
    $text_color = "";
    $id_string = "";

    if (array_key_exists("styled", $options)) {
        $component = $options["component"];
        $id = $component->id;
        $id_string = "id='component_$id'";
        $text_color = $component->reverse_text === 1 ? "component--rev" : "";
        $align_h = "component--h-" . $component->alignment_horizontal->name;
        $align_v = "component--v-" . $component->alignment_vertical->name;

        // Set styled component width
        switch ($type) {
            case "carousel":
            case "image-full-width":
                $width = "page-width";
                break;
            case "image":
                $width = $component->image_component_width->name;
                break;
            default:
                $width = $component->component_width->name;
        }
    } else {
        $width = $options["width"];
    }

    $class_list = "$type component component--$width $align_h $align_v $text_color";

    $component_inner = wire("files")->render("components/$type/index.php", $options);
    return "<div $id_string class='$class_list'>
        $component_inner
    </div>";
}

function getImageMarkup($images, $width="content-width", $class="") {

    $images_out = "";

    if ($images && count($images)) {

        $image_sizes = [
            "content-width" => "(min-width: 750px) 80vw, 100vw",
            "content-half-width" => "(min-width: 1200px) 563px, (min-width: 760px) 40vw, (min-width: 560px) 50vw, 100vw",
            "text-width" => "(min-width: 1260px) 731px, (min-width: 1040px) calc(69.5vw - 131px), (min-width: 760px) 80vw, 100vw"
        ];

        $img_options = [
            "css_aspect_ratio" => true,
            "class" => "",
            "field_name" => "image",
            "sizes" => $image_sizes[$width],
            "lazy_load" => true,
            "webp" => true
        ];

        $images_out = "<div class='$class'>";

        foreach ($images as $image) {
            $dsc = $image->description;
            $img_options["alt_str"] = $dsc ? $dsc : "Example of our work";
            $img_options["image"] = $image;

            $images_out .= getLazyImageMarkup($img_options);
        }

        $images_out .= "</div>";
    }
    return $images_out;
}

function getLazyImageMarkup($image_options) {

    $lazyImages = wire("modules")->get("LazyResponsiveImages");

    return $lazyImages->renderImage($image_options);
}