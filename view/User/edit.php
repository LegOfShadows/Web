<form class="ctrlItemForm" action="/user/edit" method="POST">
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