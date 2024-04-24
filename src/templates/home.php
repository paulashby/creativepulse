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

// Using a full width image as a video placeholder
$video_placeholder_options = [
    "type" => "image-full-width",
    "width" => "page-width",
    "component" => $page
];

$gallery_options = [
    "type" => "gallery",
    "width" => "page-width",
    "content" => $projects
];

$title_block = renderComponent($title_options);
$video_placeholder = renderComponent($video_placeholder_options);
$gallery = renderComponent($gallery_options);

?>

<main data-pw-id="main-region">
    <?= $title_block ?>
    <?= $video_placeholder ?>
    <?= $gallery ?>
</main>
