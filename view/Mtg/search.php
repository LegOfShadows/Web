<form id="mtgSearch" method="post" action="/mtg/search">
    <input name="search" type="text">
    <input type="submit" value="Search">
</form>
<?php
if (isset($cards)) {
    $count = count($cards);
    echo Html::CreateElement('h4',"Found $count card(s)");
    foreach ($cards as $card) {
        Mtg::ParseMana($card['cost']);
        Html::GetElement('card',$card);
    }
} else {
    echo Html::CreateElement('h4',"No matches found");
}
// Completely pointless, but epic, easter egg;
if (isset($potato)) {
    echo html::CreateElement('h1','No Potato for you!');
}
?>