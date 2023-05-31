<?php namespace ProcessWire;

$projects = $pages->find("template=project");
$sticky_title = renderComponent("sticky-title", "page-width");
$gallery = renderComponent("gallery", "page-width", $vars=["content" => $projects]);

?>

<main data-pw-id="main-region">

<?= $sticky_title ?>
<?= $gallery ?>
    
</main>
	
