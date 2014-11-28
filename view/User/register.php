<form class="ctrlItemForm" action="/user/register" method="POST">
	<fieldset class="ctrlItemFormGroup">
		<legend>User Registration</legend>
		<table class="ctrlItemFormTable">
			<tr>
				<td><label>First Name</label></td>
				<td><input type="text" name="firstname" class="ctrlRequired" /></td>
			</tr>
			<tr>
				<td><label>Last Name</label></td>
				<td><input type="text" name="lastname" class="ctrlRequired" /></td>
			</tr>
			<tr>
				<td><label>Email</label></td>
				<td><input type="text" name="email" class="ctrlRequired" /></td>
			</tr>
			<tr>
				<td><label>Username</label></td>
				<td><input type="text" name="username" class="ctrlRequired" /></td>
			</tr>
			<tr>
				<td><label>Password</label></td>
				<td><input type="password" name="password1" class="ctrlRequired" /></td>
			</tr>
			<tr>
				<td><label>Verify Password</label></td>
				<td><input type="password" name="password2" class="ctrlRequired" /></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" value="Register" /></td>
			</tr>
		</table>
	</fieldset>
</form>