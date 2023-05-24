<?php namespace ProcessWire;

// Variables declared in _init.php

?>

<!DOCTYPE html>
<html lang="en">
	<head id="html-head">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
				<label for="fname" class="form-label form-label--hidden">First name</label>
				<input type="text" id="fname" name="fname" placeholder="First name">
			</form>
		</footer>
		<script src="<?= $js_url ?>"></script>
	</body>
</html>