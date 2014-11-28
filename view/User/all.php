<table class="ctrlItemTable">
	<tr>
		<th>Username</th>
		<th>Name</th>
		<th>E-Mail</th>
		<th>Access Level</th>
		<th>Last Logon</th>
		<th>Edit</th>
	</tr>
	<?php foreach ($Users as $user) {?>
	<tr style="text-align:center;">
		<td><?php echo $user['username']?></td>
		<td><?php echo $user['firstname'].' '.$user['lastname']?></td>
		<td><?php echo $user['email']?></td>
		<td><?php echo Auth::GetAccessLevel($user['accesslevel'])?></td>
		<td><?php echo $user['lastlogon']?></td>
		<td><a href="/user/edit/<?php echo $user['id']?>">Edit</a></td>
	</tr>
	<?php }?>
</table>