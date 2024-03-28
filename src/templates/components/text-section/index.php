<?php namespace ProcessWire;

$heading = $component->heading;
$text = $component->text;

?>

<?php if ($heading) : ?>
    <div class="gs_reveal gs_padding component-content">
        <div class="subheading">
            <h2><?= $heading ?></h2>
        </div>
<?php else : ?>
    <div class="gs_reveal gs_padding component-content untitled">
<?php endif; ?>
    <div class="text">
        <?= $text ?>
    </div>
</div>