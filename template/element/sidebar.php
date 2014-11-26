<?php if (isset($_SESSION['User'])) {?>
	Welcome <?php echo $_SESSION['User']['username']?>
	<a class="ctrlSidebarLink" href="/user/logout">Logout</a>
	<?php 
} else {
	?>
	<a class="ctrlSidebarLink" href="/user/login">Login</a>	
	<a class="ctrlSidebarLink" href="/user/register">Register</a>
<?php }?>
