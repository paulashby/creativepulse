<?php namespace ProcessWire;

$heading = $component->heading;
$text = $component->text;
$images_out = getImageMarkup($component->image, "content-half-width", "images");
$img_class = $images_out ? "has_image" : "";

?>

<?php if ($heading) : ?>
    <div class="gs_reveal gs_padding component-content <?= $img_class ?>">
        <div class="subheading">
            <h2><?= $heading ?></h2>
        </div>
<?php else : ?>
    <div class="gs_reveal gs_padding component-content untitled <?= $img_class ?>">
<?php endif; ?>
    <div class="text">
        <?= $text ?>
    </div>
    <?= $images_out ?>
</div>