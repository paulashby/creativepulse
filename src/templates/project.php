<?php namespace ProcessWire;

/** @var Page $project_component */

$components = $page->project_component;
$component_markup = [];

foreach ($components as $component) {
	$component_type = $component->component_type->name;

    // Carousels are always page-width
    $component_width = $component_type === "carousel" ? "page-width" : $component->component_width->name;
    
    if ($component_type === "carousel") {        
        $component_markup[] = renderComponent($component_type, $component_width, $vars=["slide_images" => $component->carousel]);
	}
    // if ($component_type === "testimonial") {  
    //     $component_markup[] = renderComponent($component_type, $component_width);      
    //     $component_markup[] = renderComponent($component_type, "content-half-width");
    //     $component_markup[] = renderComponent($component_type, "content-width");
    //     $component_markup[] = renderComponent($component_type, "page-width");
	// }
}

?>

<main data-pw-id="main-region">
	<?= implode($component_markup) ?>
</main>