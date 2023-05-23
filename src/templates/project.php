<?php namespace ProcessWire;

$components = $page->project_component;
$component_markup = [];

foreach ($components as $component) {
	$component_type = $component->component_type->name;

    if ($component_type === "carousel") {
		$component_markup[] = $files->render("components/carousel/index.php", ["slide_images" => $component->carousel]);
	}
}

?>

<main data-pw-id="main-region">
	<?= implode($component_markup) ?>
</main>