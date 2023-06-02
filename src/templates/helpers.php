<?php namespace Processwire;

// Render component of the given type in wrapper div with class based on given width
function renderComponent($type, $width, $vars = []) {
    $component_inner = wire("files")->render("components/$type/index.php", $vars);
bd($type);
    return "<div class='$type component component--$width'>
        $component_inner
    </div>";
}