<?php namespace ProcessWire;

define("BLOCK_COUNT", 12);

// $gallery_placeholders = $pages->get(1206)->gallery_image;
$projects = $pages->find("template=project");

$img_options = [
    "class" => "gs_reveal_img gallery__image",
    "field_name" => "gallery_image",
    "sizes" => "(min-width: 750px) 33.33vw, 50vw",
    "lazy_load" => true,
    "webp" => true
];
$i = 0;

?>

<ul id="project-gallery" class="gallery__blocks">
    <?php
    foreach ($projects as $project):
        $image = $project->gallery_image->first();
        $alt = $image->description;
        $img_options["alt_str"] = $alt ? $alt : "Example of our work for {$page->title}";
        $img_options["image"] = $image;
        $meta_description = $project->meta_description;
        $url = $project->path();
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
