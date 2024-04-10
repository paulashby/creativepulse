<?php namespace ProcessWire;

// Document title
$projects = $pages->find("template=project");
$gallery_options = [
    "type" => "gallery",
    "width" => "page-width",
    "content" => $projects
];

$gallery = renderComponent($gallery_options);

?>

<main data-pw-id="main-region">
    <?= $gallery ?>
</main>