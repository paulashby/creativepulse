<?php namespace ProcessWire;

$images = $component->image;

?>

<div class="gs_reveal component-content">
    <?php foreach($images as $image): ?>
        <img src="<?= $image->url ?>" alt="<?= $image->description ?>">
    <?php endforeach; ?>
</div>