<table class="ctrlItemTable">
	<tr>
		<th>Username</th>
		<th>Name</th>
		<th>E-Mail</th>
		<th>Access Level</th>
		<th>Last Logon</th>
	</tr>
	<tr style="text-align:center;">
		<td><?php echo $this->UserInfo['username']?></td>
		<td><?php echo $this->UserInfo['firstname'].' '.$this->UserInfo['lastname']?></td>
		<td><?php echo $this->UserInfo['email']?></td>
		<td><?php echo Auth::GetAccessLevel($this->UserInfo['accesslevel'])?></td>
		<td><?php echo $this->UserInfo['lastlogon']?></td>
	</tr>
	<tr>
		<td colspan="5"><a href="/user/edit">Edit Profile</a></td>
	</tr>
</table>