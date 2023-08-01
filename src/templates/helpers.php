<?php namespace Processwire;

/** @var Page $component */

// Render component of the given type in wrapper div with class based on given width
function renderComponent($options) {
    // Set defaults for unstyled components (those that are not derived from project repeater)
    $bg_color = "transparent";
    $text_color = "";

    if (array_key_exists("styled", $options)) {
        $component = $options["component"];
        $id = $component->id;
        $type = $component->component_type->name;
        $width = $type === "carousel" ? "page-width" : $component->component_width->name;
        $bg_color = $component->bg_color;
        $text_color = $component->reverse_text === 1 ? "component--rev" : "";
    } else {
        $type = $options["type"];
        $width = $options["width"];
    }
    
    $component_inner = wire("files")->render("components/$type/index.php", $options);
    return "<div id='component_$id' class='$type component component--$width $text_color' style='background-color: $bg_color'>
        $component_inner
    </div>";
}