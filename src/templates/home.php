<?php
namespace ProcessWire;

/** @var Page $intro */

// Document title
$title = "Hello. We’re the Creative Pulse.";
$projects = $pages->find("template=project");

$sticky_title_options = [
    "type" => "title-sticky",
    "width" => "page-width",
    "title" => "Hello. We’re the <span class='no-wrap'>Creative Pulse.</span>",
    "intro" => $page->intro
];

$gallery_options = [
    "type" => "gallery",
    "width" => "page-width",
    "content" => $projects
];

$sticky_title = renderComponent($sticky_title_options);
$gallery = renderComponent($gallery_options);

?>

<main data-pw-id="main-region">

    <?= $sticky_title ?>
    <?= $gallery ?>
    <div class="content-sticky-wrapper">
        <div class="content">
            <div
                style="width: 100vw; height: 400px; box-sizing: border-box; padding: 3rem; margin-bottom: 2rem; background-color: gray">
                Placeholder content</div>
            <div
                style="width: 100vw; height: 200px; box-sizing: border-box; padding: 3rem; margin-bottom: 2rem; background-color: #f47832">
                Placeholder content</div>
        </div>
    </div>
</main>