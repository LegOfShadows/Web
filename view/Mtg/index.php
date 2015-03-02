<form id="mtgSearch" method="post" action="/mtg/search">
    <input name="search" type="text">
    <input type="submit" value="Search">
</form>
<?php
	if (isset($cards)) {
		foreach ($cards as $card) {
			Mtg::ParseMana($card['cost']);
			Html::GetElement('card',$card);
		}
	}
?>