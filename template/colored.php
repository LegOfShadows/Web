<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- METADATA -->
	<meta charset="UTF-8">
	<meta name="description" content="Leg of Shadows Clan Website">
	<meta name="author" content="Ivan Chernikov">
	<meta name="keywords" content="los,clan,clam,leg,of,shadows,shadow,gaming">
	<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
	<!-- END METADATA -->
	<!-- LINKS -->
	<link rel="icon" type="image/x-icon" href="/favicon.ico" sizes="16x16">
	<link rel="icon" type="image/png" href="/favicon.png" sizes="16x16">
    <?php
        HTML::Style(CSS_DIR . 'base_mobile.css',"only screen and (max-device-width: 999px)");
        HTML::Style(CSS_DIR . 'base_default.css',"only screen and (min-device-width: 1000px)");
        HTML::Style(CSS_DIR. 'color/blue.css'); // Include style preference
    ?>
	<!-- END LINKS -->
	<!-- SCRIPTS -->
	<script type="text/javascript" src="/js/lib.js"></script>
	<!-- SCRIPTS -->
	<title><?php echo APP_TITLE.': '.$this->title?></title>
</head>
<body>
	<header>
		<h1><?php echo APP_TITLE?></h1>
        <?php echo Html::GetElement('userbar')?>
	</header>
	<nav><?php echo Html::GetElement('menu')?></nav>
	<?php echo Html::Flash()?>
	<main>
        <h2><?php echo $this->title?></h2>
        <?php include $this->path?>
    </main>
	<footer>
		<p>Written by Shadow</p>
        <p>Additional thanks to [insert names here]</p>
        <p>LoS is not recruiting</p>
        <p>&copy;2014-2015</p>
	</footer>
	<?php
	if (DEBUG_MODE) {
		echo '<div id="wrpDebug">';
		echo $GLOBALS ['debug'];
		echo '</div>';
	}
	?>
</body>
</html>