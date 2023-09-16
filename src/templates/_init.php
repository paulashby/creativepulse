<?php
namespace ProcessWire;

/** @var Page $page */
/** @var Pages $pages */
/** @var Config $config */

include "./helpers.php";

$user_agent = get_browser_name($_SERVER["HTTP_USER_AGENT"]);
$page_title = $page->title;
$title = $page_title === "Home" ? "Creative Pulse" : $page_title;
$name = $page->name;
$template_name = $page->template->name;
$home = $pages->get('/');
$top_level_pages = $home->children;
$template_path = $config->urls->templates;
$js_url = $template_path . glob("js/main.min.*.js")[0];
$css_url = $template_path . glob("css/main.min.*.css")[0];
$nav = $files->render("components/nav/index.php", ["entries" => $top_level_pages]);
$footer = $files->render("components/footer/index.php");
$class_string = $template_name === $name ? "$template_name $user_agent" : "$template_name $name $user_agent";


$meta_description_str = $page->meta_description;
if ($template_name === "project") {
    $file_name = "{$template_path}css/custom/$name.css";
    $custom_css_link = "<link rel='stylesheet' type='text/css' href='$file_name'>";
    $meta_description_fallback = "Creative Pulse for $page_title: $page->scope";
} else {
    $custom_css_link = "";
    $meta_description_fallback = $page->id === 1 ? "Hello. We're the Creative Pulse. Get in touch via the contact form or view a project from the gallery." : $page_title;
}

$meta_description = strlen($meta_description_str) ? $meta_description_str : $meta_description_fallback;

function get_browser_name($user_agent)
{
    if (strpos($user_agent, "Opera") || strpos($user_agent, "OPR/"))
        return "opera";
    elseif (strpos($user_agent, "Edge"))
        return "edge";
    elseif (strpos($user_agent, "Chrome"))
        return "chrome";
    elseif (strpos($user_agent, "Safari"))
        return "safari";
    elseif (strpos($user_agent, "Firefox"))
        return "firefox";
    elseif (strpos($user_agent, "MSIE") || strpos($user_agent, "Trident/7"))
        return "ie";

    return "Other";
}

?>