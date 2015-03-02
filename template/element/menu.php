<?php
$links = array (
		'Home' => '/home',
		'Test' => '/home/test',
		'Forum' => '/forum',
		'MTG' => '/mtg'
);
if (Auth::Check ( 3 )) {
	$links ['Admin'] = '/user/all';
}
foreach ( $links as $k => $v ) {
	$link = Html::CreateLink ( $k, $v );
	echo Html::CreateElement ( 'li', $link );
}
?>