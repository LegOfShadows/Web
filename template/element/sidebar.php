<?php if (isset($user)) {?>
	Welcome <?php echo $user?>
	<a class="ctrlSidebarLink" href="/user/logout">Logout</a>
	<?php 
} else {
	?>
	<a class="ctrlSidebarLink" href="/user/login">Login</a>	
	<a class="ctrlSidebarLink" href="/user/register">Register</a>
<?php }?>
