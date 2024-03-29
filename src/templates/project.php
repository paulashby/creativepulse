<?php namespace ProcessWire;

/** @var Page $project_component */

$display_title = $page->display_title;
$intro = $page->intro;
$scope = $page->scope;
$hero_markup = "";

if (count($page->hero_image)) {
    $hero_img_options = [
        "class" => "hero-image",
        "lazy_load" => false,
        "webp" => true
    ];

    $hero = $page->hero_image->first();
    $dsc = $hero->description;
    $hero_img_options["alt_str"] = $dsc ? $dsc : "Hero image capturing the essence of the {$page->title} project";
    $hero_img_options["image"] = [
        "hero_image" => [
            "image" => $hero,
            "media" => "(min-width: 650px)",
            "sizes" => "(min-width: 1200px) 1130px, (min-width: 1040px) 80vw, (min-width: 660px) 100vw"
        ],
        "hero_image_narrow" => [
            "image" => $page->hero_image_narrow->first(),
            "media" => "(max-width: 649px)",
            "sizes" => "100vw"
        ]
    ];
    $lazy_hero_img = getLazyImageMarkup($hero_img_options);
    $hero_markup = "<div class='gs_reveal hero'>
        $lazy_hero_img
    </div>";
}

$components = $page->project_component;
$component_markup = [];

foreach ($components as $component) {
	$component_type = $component->component_type->name;
    $component_options = [
        "component" => $component,
        "styled"    => true
    ];

    $component_markup[] = renderComponent($component_options);
}

?>

<main data-pw-id="main-region">
    <div class="project-header component component--content-width">
        <div class="component-content">
            <div class="gs_reveal display">
                <h1 id="headline">
                    <?= $display_title ?>
                </h1>
                <?= $intro ?>
            </div>
            <div class="gs_reveal overview">
                <h2 class="head--client"><?= $title ?></h2>
                <p class="scope"><?= $scope ?></p>
            </div>
            <?= $hero_markup ?>
        </div>
    </div>
	<?= implode($component_markup) ?>
</main>