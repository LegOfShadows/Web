<!DOCTYPE html>
<html>
<head>
	<title><?php echo APP_TITLE.': '.$this->title?></title>
	<?php echo $this->GetStyles()?>
</head>
<body>
	<div id="wrpSidebar">
		<?php echo $this->GetElement('sidebar')?>
	</div>
	<div id="wrpMain">
		<div id="wrpHeader">
			<h1><?php echo APP_TITLE?></h1>
		</div>
		<div id="wrpNavigation">
			<ul id="ctrlMenu">
				<?php echo $this->GetElement('menu')?>
			</ul>
		</div>
		<?php echo $this->Flash()?>
		<div id="wrpContent">
			<div id="wrpTitle">
				<h2><?php echo $this->title?></h2>
			</div>
			<?php echo $this->GetView()?>
		</div>
		<div id="wrpFooter">
			<p id="ctrlSignature">Written by Shadow</p>
			<p id="ctrlCopyrights">Clean-Template &copy; 2014</p>
		</div>
	</div>
	<?php 
	if (DEBUG_MODE) {
		echo '<div id="wrpDebug">';
		echo $GLOBALS['debug'];
		echo '</div>';
	}?>
</body>
</html>