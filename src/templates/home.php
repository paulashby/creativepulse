<?php namespace ProcessWire;

/** @var Page $intro */

$title = "Hello. We’re the <span class='no-wrap'>Creative Pulse.</span>";
$intro = $page->intro;
$projects = $pages->find("template=project");

$sticky_title = renderComponent("sticky-title", "page-width", $vars=["title" => $title, "intro" => $intro]);
$gallery = renderComponent("gallery", "page-width", $vars=["content" => $projects]);

?>

<main data-pw-id="main-region">

<?= $sticky_title ?>
<?= $gallery ?>
<div style="margin-top: calc( -50vw / 3 + 77px ); width: 100vw; height: 100vh; background-color: green; position: relative; z-index: 2"></div>
    
</main>
	
