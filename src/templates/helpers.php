<?php namespace Processwire;

// Render component of the given type in wrapper div with class based on given width
function renderComponent($type, $width, $component) {

    $bg_color = $component->bg_color;
    
    $component_inner = wire("files")->render("components/$type/index.php", $vars = ["component" => $component]);
    return "<div class='$type component component--$width' style='background-color: $bg_color'>
        $component_inner
    </div>";
}