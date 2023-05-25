<?php namespace ProcessWire;

$nav_entries = $entries->implode("\n", "<li><a href='{url}'>{title}</a></li>");
$tel_entry = "Say hello - <span class='nav__tel-num'>0800 112 3228";

?>

<nav class="nav">
    <ul class="nav__elements">
        <li class="nav__element nav__home"><a href="/" class="nav__home-link"><span class="sr-only">Home</span></a></li>
        <li class="nav__element nav__submenu">
            <ul>
                <li class="nav__submenu-toggle">
                    <div class="nav__submenu-toggle-bar"></div>
                </li>
                <li class="nav__submenu-entries">
                    <ul class="nav__submenu-entries-list">
                        <?= $nav_entries ?>
                        <li class="nav__submenu-tel"><?= $tel_entry ?></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="nav__element nav__tel"><?= $tel_entry ?></span></li>
    </ul>
</nav>