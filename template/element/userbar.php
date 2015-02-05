<div id="wrpUserBar">
<?php
if (isset ( $_SESSION ['User'] )) {
	echo Html::CreateLink ( $_SESSION ['User']->username, '/user/edit/' . $_SESSION ['User']->id );
	echo Html::CreateLink ( 'Logout', '/user/logout' );
} else {
	echo Html::CreateLink ( 'Login', '/user/login' );
	echo Html::CreateLink ( 'Register', '/user/register' );
}
?>
</div>