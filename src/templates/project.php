<?php namespace ProcessWire;

/** @var Page $project_component */

$display_title = $page->display_title;
$intro = $page->intro;
$scope = $page->scope;

$components = $page->project_component;
$component_markup = [];

foreach ($components as $component) {
	$component_type = $component->component_type->name;

    // Carousels are always page-width
    $component_width = $component_type === "carousel" ? "page-width" : $component->component_width->name;

    $component_options = [
        "component" => $component,
        "styled"    => true
    ];
    
    // if ($component_type === "carousel" ||
    if ($component_type === "text-section") {
        $component_markup[] = renderComponent($component_options);
    }
}

?>

<main data-pw-id="main-region">
    <div class="project-header">
        <h1 id="headline">
            <?= $display_title ?>
        </h1>
        <p class="intro"><?= $intro ?></p>
        <p class="head--client"><?= $title ?></p>
        <p class="scope"><?= $scope ?></p>
    </div>

	<?= implode($component_markup) ?>
</main>