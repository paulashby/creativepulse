<?php namespace Processwire;

/** @var Page $component */

// Render component of the given type in wrapper div with class based on given width
function renderComponent($options) {
    // Set defaults for unstyled components (those that are not derived from project repeater)
    $bg_color = "transparent";
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
    
    $component_inner = wire("files")->render("components/$type/index.php", $options);
    return "<div $id_string class='$type component component--$width $align_h $align_v $text_color'>
        $component_inner
    </div>";
}