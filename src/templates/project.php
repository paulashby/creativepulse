<?php namespace ProcessWire;

/** @var Page $project_component */

$display_title = $page->display_title;
$intro = $page->intro;
$scope = $page->scope;
$hero = $page->image->first();
$hero_url = $hero->url;
$hero_alt = $hero->description;

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
    
    if ($component_type !== "carousel") {
        $component_markup[] = renderComponent($component_options);
    }
}

?>

<main data-pw-id="main-region">
    <div class="project-header component component--content-width">
        <div class="component-content">
        <div class="display">
            <h1 id="headline">
                <?= $display_title ?>
            </h1>
            <p class="intro"><?= $intro ?></p></div>
        <div class="overview">
            <h2 class="head--client"><?= $title ?></h2>
            <p class="scope"><?= $scope ?></p>
        </div>        
        <div class="hero">
            <img class="hero-image" src="<?= $hero_url ?>" alt="<?= $hero_alt ?>"></div>
        </div>
    </div>

	<?= implode($component_markup) ?>
</main>