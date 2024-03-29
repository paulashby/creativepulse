<?php
namespace ProcessWire;

$images_out = getImageMarkup($component->image, $component->image_component_width->name, "gs_reveal component-content");

echo $images_out;