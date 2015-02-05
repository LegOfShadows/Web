<div id="wrpSidebarShow">
	<a class="ctrlSidebarLink" href="Javascript:void(0)"
		onclick="showSidebar(this)">>></a>
</div>
<div id="wrpSidebar" class="wrpHidden">
	<script type='text/javascript'>
function hideSidebar(elem) {
	elem.parentElement.className = 'fadeOutLeft animated';
	document.getElementById('wrpSidebarShow').className = 'fadeInLeft animated';
}
function showSidebar(elem) {
	elem.parentElement.nextElementSibling.className = 'fadeInLeft animated';
	document.getElementById('wrpSidebarShow').className = 'fadeOutLeft animated';
}
</script>
<?php if (isset($_SESSION['User'])) {?>
	<a class="ctrlSidebarLink" href="/user/index"><?php echo $_SESSION['User']->username?></a>
	<a class="ctrlSidebarLink" href="/user/logout">Logout</a>
	<?php if (Auth::Check(3)) {?>
	<hr>
	<a class="ctrlSidebarLink" href="/user/all">User List</a>
	<hr>
	<?php
	
}
	$status = 'User Level: ' . Auth::AccessLevel ( $_SESSION ['User']->accesslevel );
	echo Html::CreateElement ( 'div', $status, array (
			'class' => 'ctrlSidebarItem' 
	) );
	$lastlogon = 'Last Logon: ' . Date::StrToDate ( $_SESSION ['User']->lastlogon );
	echo Html::CreateElement ( 'div', $lastlogon, array (
			'class' => 'ctrlSidebarItem' 
	) );
} else {
	?>
	<a class="ctrlSidebarLink" href="/user/login">Login</a> <a
		class="ctrlSidebarLink" href="/user/register">Register</a>
<?php }?>
	<hr>
	<a class="ctrlSidebarLink" href="Javascript:void(0)"
		onclick="hideSidebar(this)">Hide</a>
</div>
