<?php
namespace ProcessWire;

/** @var Page $intro */

// Document title
$projects = $pages->find("template=project");

$title_options = [
    "type" => "title",
    "width" => "page-width",
    "title" => "Hello. We’re the <span class='no-wrap'>Creative Pulse.</span>",
    "intro" => $page->intro
];

$gallery_options = [
    "type" => "gallery",
    "width" => "page-width",
    "content" => $projects
];

$title_block = renderComponent($title_options);
$gallery = renderComponent($gallery_options);

?>

<main data-pw-id="main-region">
    <?= $gallery ?>
    <?= $title_block ?>
</main>
