<?php namespace ProcessWire;

$video_url = $component->video->url;
$poster_image = $component->image;

if (count($poster_image)) {
    $p_image = $poster_image->first();
    $poster_data_attribs = "data-poster data-poster-0='{$p_image->size(810, 0)->url}' data-poster-660='{$p_image->size(1500, 0)->url}' data-poster-1040='{$p_image->size(2048, 0)->url}' data-poster-1200='{$p_image->size(2550, 0)->url}'";
} else {
    $poster_data_attribs = "";
}

?>

<div class="gs_reveal component-content">
    <video autoplay="" muted="" controls="" controlslist="" loop="" preload="metadata" <?= $poster_data_attribs ?>>
        <source type="video/mp4" src="<?= $video_url ?>">
    </video>
</div>