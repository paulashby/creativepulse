<?php namespace ProcessWire;

$heading = $component->heading;
$text = $component->text;

?>

<?php if ($heading) : ?>
    <div class="component-content">
        <div class="subheading">
            <h2><?= $heading ?></h2>
        </div>
<?php else : ?>
    <div class="component-content untitled">
<?php endif; ?>
    <div class="text">
        <p><?= $text ?><p>
    </div>
</div>