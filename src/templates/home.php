<?php namespace ProcessWire;

$projects = $pages->find("template=project");
$gallery = renderComponent("gallery", "page-width", $vars=["content" => $projects]);

?>

<main data-pw-id="main-region">

<?= $gallery ?>
    
</main>
	
