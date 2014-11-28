<?php $id = $UserInfo['id']?>
<?php

if (Auth::Check ( 3 )) {
	?>
<form class="ctrlItemForm" action="/user/edit/<?php echo $id?>"
	method="POST">
	<input type="hidden" name="id" value="<?php echo $id?>" /> <input
		type="hidden" name="action" value="admin" />
	<fieldset class="ctrlItemFormGroup">
		<legend>Manage User</legend>
		<table class="ctrlItemFormTable">
			<tr>
				<td>Username</td>
				<td><?php echo $UserInfo['username']?></td>
			</tr>
			<tr>
				<td>Full Name</td>
				<td><?php echo $UserInfo['firstname']?> <?php echo $UserInfo['lastname']?></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><?php echo $UserInfo['email']?></td>
			</tr>
			<tr>
				<td><label>Reset Password</label></td>
				<td><input type="checkbox" name="password_reset" value="reset" /></td>
			</tr>
			<tr>
				<td><label>Change User Access Level</label></td>
				<td><select name="accesslevel">
					<?php
	foreach ( Auth::$Levels as $k => $v ) {
		echo "<option value='$k'";
		if ($UserInfo ['accesslevel'] == $k) {
			echo ' selected';
		}
		echo ">$v</option>";
	}
	?>
				</select></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="Apply Changes" /></td>
			</tr>
		</table>
	</fieldset>
</form>
<?php } if ($_SESSION['User']['id'] == $id) {?>
<form class="ctrlItemForm" action="/user/edit/<?php echo $id?>"
	method="POST">
	<input type="hidden" name="id" value="<?php echo $id?>" /> <input
		type="hidden" name="action" value="password" />
	<fieldset class="ctrlItemFormGroup">
		<legend>Change Password</legend>
		<table class="ctrlItemFormTable">
			<tr>
				<td><label>Password</label></td>
				<td><input type="password" name="password" class="ctrlRequired" /></td>
			</tr>
			<tr>
				<td><label>New Password</label></td>
				<td><input type="password" name="password1" class="ctrlRequired" /></td>
			</tr>
			<tr>
				<td><label>Verify Password</label></td>
				<td><input type="password" name="password2" class="ctrlRequired" /></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="Change Password" /></td>
			</tr>
		</table>
	</fieldset>
</form>
<?php }?>