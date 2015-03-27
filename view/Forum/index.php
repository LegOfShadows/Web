<?php
$access = 1;
if (isset ( $_SESSION ['User'] )) {
	$access = $_SESSION ['User']->accesslevel;
}

if (isset ( $categories )) {
	foreach ( $categories as $cat ) {
		if ($cat ['accesslevel'] <= $access) {
			?>
<dl>
    <dt><?php echo Html::CreateLink ($cat ['name'], '/forum/index/' . $cat ['id'] )?></dt>
    <dd><?php echo $cat ['count'] . ' ' . ($cat ['count'] > 1 ? 'Threads' : 'Thread')?></dd>
</dl>
			<?php
		}
	}
} else {
	foreach ( $threads as $thread ) {
        ?>
        <dl>
            <dt><?php echo Html::CreateLink ( $thread ['title'], '/forum/thread/' . $thread ['id'] ); ?></dt>
            <dd>
                <details>
                    <summary><?php echo $thread ['count'] . ' ' . ($thread ['count'] > 1 ? 'Posts' : 'Post') ?></summary>
                    <address>OP: <?php echo $thread ['owner'] ?></address>
                    <time><?php echo $thread ['created'] ?></time>
                </details>


            </dd>
        </dl>
<?php
	}
	if (Auth::Check ( 2 )) {
		echo Html::CreateLink ( 'New Thread', '/forum/create/', array (
				'class' => 'ctrlItemButton' 
		) );
	}
}