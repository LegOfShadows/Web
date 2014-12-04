<table class="ctrlItemTable">
<?php if (isset($categories)) {?>
	<tr>
		<th>Category</th>
		<th># Threads</th>
	</tr>
<?php
	foreach ( $categories as $cat ) {
		if ($cat ['accesslevel'] <= $_SESSION ['User']->accesslevel) {
			?>
	<tr>
		<td><a href="/forum/index/<?php echo $cat['id']?>"><?php echo $cat['name'] ?></a></td>
		<td><?php echo $cat['count'] ?></td>
	</tr>
	
<?php }}} else {?>
	<tr>
		<th>Title</th>
		<th>Author</th>
	</tr>
	<?php foreach ($threads as $thread) {?>
	<tr>
		<td><?php echo $thread['title']?></td>
		<td><?php echo $thread['owner']?></td>
	</tr>
<?php }}?>
</table>