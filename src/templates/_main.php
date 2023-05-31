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
	<body id="html-body" class="<?= $template_name ?> <?= $name ?>">
        <?= $nav ?>
		<main data-pw-id="main-region">
            <h1 id="headline">
                <?= $title ?>
            </h1>
		</main>
        <?= $footer ?>
		<script src="<?= $js_url ?>"></script>
	</body>
</html>