<!DOCTYPE html>
<html>
<head>
<title><?php echo APP_TITLE.': '.$this->title?></title>
	<?php
	Html::Style ( CSS_DEFAULT );
	Html::Style ( CSS_DIR . 'animate.css' );
	Html::Style ( CSS_DIR . 'forum.css' )
	?>
</head>
<body>
	<?php //echo Html::GetElement('sidebar')?>
	</div>
	<div id="wrpMain">
		<div id="wrpHeader">
			<h1><?php echo APP_TITLE?></h1>
			<?php echo Html::GetElement('userbar')?>
		</div>
		<div id="wrpNavigation">
			<ul id="ctrlMenu">
				<?php echo Html::GetElement('menu')?>
			</ul>
		</div>
		<?php echo Html::Flash()?>
		<div id="wrpContent">
			<div id="wrpTitle">
				<h2><?php echo $this->title?></h2>
			</div>
			<?php include $this->path?>
		</div>
		<div id="wrpFooter">
			<p id="ctrlSignature">Written by Shadow</p>
			<p id="ctrlCopyrights">Clean-Template &copy; 2014</p>
		</div>
	</div>
	<?php
	if (DEBUG_MODE) {
		echo '<div id="wrpDebug">';
		echo $GLOBALS ['debug'];
		echo '</div>';
	}
	?>
</body>
</html>