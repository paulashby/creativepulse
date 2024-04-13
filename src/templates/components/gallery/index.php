<?php namespace ProcessWire;

define("BLOCK_COUNT", 12);

// $gallery_placeholders = $pages->get(1206)->gallery_image;
$projects = $pages->find("template=project");

$img_options = [
    "css_aspect_ratio" => true,
    "class" => "gs_reveal_img gallery__image",
    "field_name" => "gallery_image",
    "sizes" => "(min-width: 750px) 30vw, 50vw",
    "lazy_load" => true
];
$i = 0;

?>

<ul id="project-gallery" class="gallery__blocks">
    <?php
    foreach ($projects as $project):
        $image = $project->gallery_image;
        $first_image = $image->first();
        $is_animated_gif = $first_image->ext === "gif";
        $alt = $first_image->description;
        $img_options["alt_str"] = $alt ? $alt : "Example of our work for {$page->title}";
        $meta_description = $project->meta_description;
        $url = $project->path();

        if ($is_animated_gif) {
            // All gifs on this website are animated - static images are served in a different format.
            // As the ProcessWire image sizer is discarding the animation when generating size variations,
            // we're providing pre-sized variations in a Pageimages array.
            // So we pass the array instead of the first image to getLazyImageMarkup
            // And do not request webps which would also be static for the same reason.
            $img_options["image"] = $image;
            $img_options["webp"] = false;
        } else {
            $img_options["image"] = $first_image;
            $img_options["webp"] = true;
        }
    ?>
        <li id="block--<?= $i ?>" class="gallery__block">
            <a href="<?= $url ?>">
                <?= getLazyImageMarkup($img_options) ?>
                <div class="gallery__info">
                    <div class="gallery__info-content">
                        <p class="gallery__info-description">
                            <?= $meta_description ?>
                        </p>
                    </div>
                </div>
            </a>
        </li>
    <?php
    $i++;
    endforeach; ?>
</ul>
