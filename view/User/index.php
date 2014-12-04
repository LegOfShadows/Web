<table class="ctrlItemTable">
	<tr>
		<th>Username</th>
		<th>Name</th>
		<th>E-Mail</th>
		<th>Access Level</th>
		<th>Last Logon</th>
	</tr>
	<tr style="text-align:center;">
		<td><?php echo $User->username?></td>
		<td><?php echo $User->firstname.' '.$User->lastname?></td>
		<td><?php echo $User->email?></td>
		<td><?php echo Auth::AccessLevel($User->accesslevel)?></td>
		<td><?php echo $User->lastlogon?></td>
	</tr>
	<tr>
		<td colspan="5"><a href="/user/edit/<?php echo $User->id?>">Edit Profile</a></td>
	</tr>
</table>