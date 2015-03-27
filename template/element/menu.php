<?php
$links = array (
    'Home' => '/home',
    //'Test' => '/home/test',
    'Forum' => '/forum',
    'Gallery' => '/gallery',
    'MTG' => '/mtg'
);
if (Auth::Check ( 3 )) {
	$links ['Admin'] = '/user/all';
}
foreach ( $links as $k => $v ) {
	echo Html::CreateLink ( $k, $v, array('type' => 'text/html') );
}
?>