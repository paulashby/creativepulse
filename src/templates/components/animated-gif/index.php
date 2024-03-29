<?php
namespace ProcessWire;

$image = $component->animated_gif->first();
$aspect_ratio = $image->ratio;
$full_size_url = $image->url;
/*
// There's a bug with the Animated GIF Image Sizer in php 8
// https://processwire.com/talk/topic/19700-animated-gif-resize-issue/page/2/
$variations = [
    510,
    960,
    1280
];
$srcset = getSrcSet($image, $variations);
$src_url = $image->size("510", 0)->url;

function getSrcSet($image, $variations) {
    $srcset = "";

    foreach ($variations as $size) {
        $var_img = $image->size($size, 0);
        $srcset .= $var_img->url . " {$size}w,";
    }
    return substr($srcset, 0, -1); // Remove trailing comma
}


<picture>
    <source sizes="(min-width: 1200px) 1130px, (min-width: 550px) 960px, 510px" srcset="<?= $srcset ?>">
    <img alt="Promotional graphics" style="aspect-ratio:<?= $aspect_ratio ?>" src="<?= $src_url ?>">
</picture> */
?>

<div class="gs_reveal component-content">
    <img alt="Promotional graphics" style="aspect-ratio:<?= $aspect_ratio ?>" src="<?= $full_size_url ?>">
</div>