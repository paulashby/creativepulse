<?php namespace ProcessWire;

$heading = $component->heading;
$text = $component->text;
$attribution_name = $component->attribution_name;
$attribution_role = $component->attribution_role;

?>


<div class="gs_reveal component-content">
    <h2 class="subheading"><?= $heading ?></h2>
    <div class="text">
        <?= $text ?>
    </div>
    <div class="attribution">
        <p class="attribution_name"><?= $attribution_name ?></p>
        <p class="attribution_role"><?= $attribution_role ?></p>
    </div>
</div>