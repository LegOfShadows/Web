<?php
	Log::Add('users',$Users);
?>
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
		<td><?php echo $user['user_username']?></td>
		<td><?php echo $user['user_firstname'].' '.$user['user_lastname']?></td>
		<td><?php echo $user['user_email']?></td>
		<td><?php echo Auth::GetAccessLevel($user['user_accesslevel'])?></td>
		<td><?php echo $user['user_lastlogon']?></td>
		<td><a href="/user/edit/<?php echo $user['user_id']?>">Edit</a></td>
	</tr>
	<?php }?>
</table>