<?php namespace ProcessWire;

/** @var Page $page */
/** @var Pages $pages */
/** @var Config $config */

$title = $page->title;
$home = $pages->get('/');
$top_level_pages = $home->children;
$template_path = $config->urls->templates;
$js_url = $template_path . glob( "js/main.min.*.js" )[0];
$css_url = $template_path . glob( "css/main.min.*.css" )[0];

?>

<!DOCTYPE html>
<html lang="en">
	<head id="html-head">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>
			<?= $title ?>
		</title>
		<link rel="stylesheet" type="text/css" href="<?= $css_url ?>" />
	</head>
	<body id="html-body">
		<nav>
			<ul>
				<li><a href="/">Home</a></li>
				<?= $top_level_pages->implode("\n", "<li><a href='{url}'>{title}</a></li>"); ?>
			</ul>
		</nav>
		<h1 id="headline">
			<?= $title ?>
		</h1>
		<main data-pw-id="main-region">
			Default content
		</main>
		<footer>
			<h2>Have a project in mind?</h2>
			<p>Please call, email, or fill in this form to let us know what you’re looking for.</p>
			<form action="">
				<label for="fname" class="screen-reader-text">First name</label>
				<input type="text" id="fname" name="fname" placeholder="First name">
			</form>
		</footer>
		<script src="<?= $js_url ?>"></script>
	</body>
</html>