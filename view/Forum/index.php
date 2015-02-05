<?php
$access = 1;
if (isset ( $_SESSION ['User'] )) {
	$access = $_SESSION ['User']->accesslevel;
}
?>
<div class="wrpItem">
	<div class="ctrlForumList">
<?php

if (isset ( $categories )) {
	foreach ( $categories as $cat ) {
		if ($cat ['accesslevel'] <= $access) {
			?>
		<div class="ctrlForumItem">
			<div class="ctrlForumFloatLeft"><?php echo Html::CreateLink ($cat ['name'], '/forum/index/' . $cat ['id'] )?></div>
			<div class="ctrlForumFloatRight"><?php echo $cat ['count'] . ' ' . ($cat ['count'] > 1 ? 'Threads' : 'Thread')?></div>
			<div class="ctrlForumClear"></div>
		</div>
			<?php
		}
	}
} else {
	foreach ( $threads as $thread ) {
		$link = '<div class="ctrlForumItem">';
		$link .= '<div class="ctrlForumFloatLeft">' . $thread ['title'] . '<br>Author: ' . $thread ['owner'] . '</div>';
		$link .= '<div class="ctrlForumFloatRight">' . $thread ['count'] . ' ' . ($thread ['count'] > 1 ? 'Posts' : 'Post');
		$link .= '<br>' . $thread ['created'] . '</div>';
		$link .= '<div class="ctrlForumClear"></div>';
		$link .= '</div>';
		echo Html::CreateLink ( $link, '/forum/thread/' . $thread ['id'] );
	}
	if (Auth::Check ( 2 )) {
		echo Html::CreateLink ( 'New Thread', '/forum/create/', array (
				'class' => 'ctrlItemButton' 
		) );
	}
}
?>
</div>
</div>