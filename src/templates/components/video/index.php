<?php namespace ProcessWire;

$video_url = $component->video->url;

?>

<div class="gs_reveal component-content">
    <video autoplay="" muted="" controls="" controlslist="" loop="" preload="metadata">
        <source type="video/mp4" src="<?= $video_url ?>">
    </video>
</div>