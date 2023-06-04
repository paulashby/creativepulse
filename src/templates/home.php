<?php namespace ProcessWire;

/** @var Page $intro */

$title = "Hello. We’re the Creative Pulse.";
$intro = $page->intro;
$projects = $pages->find("template=project");

$sticky_title = renderComponent("sticky-title", "page-width", $vars=["title" => "Hello. We’re the <span class='no-wrap'>Creative Pulse.</span>", "intro" => $intro]);
$gallery = renderComponent("gallery", "page-width", $vars=["content" => $projects]);

?>

<main data-pw-id="main-region">

    <?= $sticky_title ?>
    <?= $gallery ?>
    <div class="content-sticky-wrapper">
        <div class="content">
            <div style="width: 100vw; height: 85vh; box-sizing: border-box; padding: 3rem; margin-bottom: 2rem; background-color: green">Placeholder content</div>
            <div style="width: 100vw; height: 50vh; box-sizing: border-box; padding: 3rem; margin-bottom: 2rem; background-color: blue">Placeholder content</div>
        </div>
    </div>
</main>
	
