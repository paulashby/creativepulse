<?php namespace ProcessWire;

$video_url = $component->video->url;

?>

<div class="component-content">
    <video autoplay="" controls="" controlslist="" loop="" preload="metadata">
        <source type="video/mp4" src="<?= $video_url ?>">
    </video>
</div>