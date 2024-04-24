<?php namespace ProcessWire;

// We're now including only Projects in the navigation - this with the #nav-link__projects id appended
// So the Projects link goes to the gallery on the home page while the logo home page link just loads the page

$projects = $pages->find("template=project");
// Generate navigation list of projects
$project_links = $projects->each(function($project) {
    return "<li class='nav__submenu-entries-list-link'><a href='$project->url'>$project->title</a></li>";
});

$nav_entries = "<li class='nav__submenu-entries-list-link link__projects'>
    <a href='/#project-gallery' >Projects</a>
</li>
<li class='nav__submenu-projects-list'>
    <ul>
        $project_links
    </ul>
</li>";





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
                        <li class="nav__submenu-entries-list-tel"><span class='nav__tel-txt'>Say hello - </span>0800 112 3228</li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</nav>
