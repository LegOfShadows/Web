<div class="ctrlForumList">
<?php foreach ($posts as $post) { ?>
	<div class="ctrlForumPost">
		<div class="ctrlForumPostAuthor">
			<div class="ctrlForumUser"><?php echo $post['username']?></div>
			<div class="ctrlForumLevel"><?php echo Auth::AccessLevel($post['accesslevel'])?></div>
			<div class="ctrlForumDate"><?php echo $post['created']?></div>
		</div>
		<div class="ctrlForumPostBody"><?php echo $post['text']?></div>
		<div class="ctrlForumClear"></div>
	</div>
<?php }?>
	<div class="ctrlForumReply">
		<a href="/forum/post/<?php echo $thread->id?>" class="ctrlItemButton">Reply</a>
	</div>
</div>