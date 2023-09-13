<?php namespace ProcessWire;

// Variables declared in _init.php

?>

<!DOCTYPE html>
<html lang="en">
	<head id="html-head">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			<?= $title ?>
		</title>
		<link rel="stylesheet" type="text/css" href="<?= $css_url ?>">
        <?= $custom_css_link ?>
        <link rel="apple-touch-icon" sizes="180x180" href="<?= $template_path ?>img/apple-touch-icon.png?v=1">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= $template_path ?>img/favicon-32x32.png?v=1">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= $template_path ?>img/favicon-16x16.png?v=1">
        <link rel="manifest" href="<?= $template_path ?>img/site.webmanifest?v=1">
        <link rel="mask-icon" href="<?= $template_path ?>img/safari-pinned-tab.svg?v=1" color="#5bbad5">
        <link rel="shortcut icon" href="<?= $template_path ?>img/favicon.ico?v=1">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="<?= $template_path ?>img/browserconfig.xml?v=1">
        <meta name="theme-color" content="#ffffff">
	</head>
	<body id="html-body" class="<?= $class_string ?>">
        <script>document.body.classList.add("js")</script>
        <?= $nav ?>
        <main data-pw-id="main-region">
            <h1 id="headline">
                <?= $title ?>
            </h1>
		</main>
        <?= $footer ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
        <script src="<?= $js_url ?>"></script>
	</body>
</html>