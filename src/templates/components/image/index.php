<?php namespace ProcessWire;

$images = $component->image;

?>

<div class="component-content">
    <?php foreach($images as $image): ?>
        <img src="<?= $image->url ?>" alt="<?= $image->description ?>">
    <?php endforeach; ?>
</div>