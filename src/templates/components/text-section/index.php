<?php namespace ProcessWire;

$heading = $component->heading;
$text = $component->text;

?>

<?php if ($heading) : ?>
    <div class="component-content">
        <h2 class="subheading"><?= $heading ?></h2>
<?php else : ?>
    <div class="component-content untitled">
<?php endif; ?>
    <div class="text">
        <p><?= $text ?><p>
    </div>
</div>