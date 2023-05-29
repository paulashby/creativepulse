<?php namespace ProcessWire;

/** @var Page $page */
/** @var Pages $pages */
/** @var Config $config */

include "./helpers.php";

$title = $page->title;
$home = $pages->get('/');
$top_level_pages = $home->children;
$template_path = $config->urls->templates;
$js_url = $template_path . glob( "js/main.min.*.js" )[0];
$css_url = $template_path . glob( "css/main.min.*.css" )[0];
$nav = $files->render("components/nav/index.php", ["entries" => $top_level_pages]);
$footer = $files->render("components/footer/index.php");

?>

