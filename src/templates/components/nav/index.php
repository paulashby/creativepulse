<?php namespace ProcessWire;

?>

<nav>
    <ul>
        <li><a href="/">Home</a></li>
        <?= $entries->implode("\n", "<li><a href='{url}'>{title}</a></li>"); ?>
    </ul>
</nav>