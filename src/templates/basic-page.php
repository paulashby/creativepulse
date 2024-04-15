<?php namespace ProcessWire;

$options = [
    "component" => $page
];

$component_inner = wire("files")->render("components/image-full-width/index.php", $options);

?>

<main data-pw-id="main-region">
    <div class="component component--text-width">
        <div class="component-content">
            <h1><?= $page->heading ?></h1>
        </div>
    </div>
    <div class="component image-full-width component--page-width">
        <?= $component_inner ?>
    </div>
</main>

