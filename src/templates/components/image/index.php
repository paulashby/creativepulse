<?php namespace ProcessWire;

$image = $component->image->first();
$image_url = $image->url;
$alt_text = $image->description;

?>

<div class="component-content">
    <img src="<?= $image_url ?>" alt="<?= $alt_text ?>">
</div>