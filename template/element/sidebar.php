<div id="wrpSidebarShow">
	<a class="ctrlSidebarLink" href="Javascript:void(0)"
		onclick="showSidebar(this)">Sidebar</a>
</div>
<div id="wrpSidebar" class="wrpHidden">
	<script type='text/javascript'>
function hideSidebar(elem) {
	elem.parentElement.className = 'fadeOutLeft animated';
	document.getElementById('wrpSidebarShow').className = 'fadeInDown animated';
}
function showSidebar(elem) {
	elem.parentElement.nextElementSibling.className = 'fadeInLeft animated';
	document.getElementById('wrpSidebarShow').className = 'fadeOutUp animated';
}
</script>
<?php if (isset($_SESSION['User'])) {?>
	<a class="ctrlSidebarLink" href="/user/index"><?php echo $_SESSION['User']['username']?></a>
	<a class="ctrlSidebarLink" href="/user/logout">Logout</a>
	<?php if (Auth::Check(3)) {?>
	<hr>
	<a class="ctrlSidebarLink" href="/user/all">User List</a>
	<hr>
	<?php }
	$status = 'User Level: ' . Auth::GetAccessLevel ( $_SESSION ['User'] ['accesslevel'] );
	echo Html::CreateElement ( 'div', $status, false, 'ctrlSidebarItem' );
	$lastlogon = 'Last Logon: ' . Date::StrToDate ( $_SESSION ['User'] ['lastlogon'] );
	echo Html::CreateElement ( 'div', $lastlogon, false, 'ctrlSidebarItem' );
} else {
	?>
	<a class="ctrlSidebarLink" href="/user/login">Login</a> <a
		class="ctrlSidebarLink" href="/user/register">Register</a>
<?php }?>
	<hr>
	<a class="ctrlSidebarLink" href="Javascript:void(0)"
		onclick="hideSidebar(this)">Hide</a>
</div>
