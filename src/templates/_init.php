<?php namespace ProcessWire;

/** @var Page $page */
/** @var Pages $pages */
/** @var Config $config */

$title = $page->title;
$home = $pages->get('/');
$top_level_pages = $home->children;
$template_path = $config->urls->templates;
$js_url = $template_path . glob( "js/main.min.*.js" )[0];
$css_url = $template_path . glob( "css/main.min.*.css" )[0];
