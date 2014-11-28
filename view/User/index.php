<table class="ctrlItemTable">
	<tr>
		<th>Username</th>
		<th>Name</th>
		<th>E-Mail</th>
		<th>Access Level</th>
		<th>Last Logon</th>
	</tr>
	<tr style="text-align:center;">
		<td><?php echo $UserInfo['username']?></td>
		<td><?php echo $UserInfo['firstname'].' '.$UserInfo['lastname']?></td>
		<td><?php echo $UserInfo['email']?></td>
		<td><?php echo Auth::GetAccessLevel($UserInfo['accesslevel'])?></td>
		<td><?php echo $UserInfo['lastlogon']?></td>
	</tr>
	<tr>
		<td colspan="5"><a href="/user/edit/<?php echo $UserInfo['id']?>">Edit Profile</a></td>
	</tr>
</table>