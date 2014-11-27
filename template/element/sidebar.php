<div id="wrpSidebar" class="fadeInLeft animated">
<script type='text/javascript'>
	document.getElementById('wrpSidebar').
</script>
<?php if (isset($_SESSION['User'])) {?>
	Welcome <?php echo $_SESSION['User']['username']?>
	<a class="ctrlSidebarLink" href="/user/logout">Logout</a>
	<?php
	echo 'Status: ';
	switch($_SESSION['User']['accesslevel']) {
		case 4:
			echo 'Admin';
			break;
		case 3:
			echo 'Mod';
			break;
		case 2:
			echo 'Author';
			break;
		case 1:
			echo 'User';
			break;
		case 0:
			echo 'Banned';
			break;
	}
	echo '<br>';
	echo 'Last Logon: '.$_SESSION['User']['lastlogon'];
} else {
	?>
	<a class="ctrlSidebarLink" href="/user/login">Login</a>	
	<a class="ctrlSidebarLink" href="/user/register">Register</a>
<?php }?>
</div>
