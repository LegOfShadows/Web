<article>
	<p>
		<span><?php echo $data['name'] ?></span>
		<span><?php echo $data['cost'] ?></span>
    </p>
	<!--<div class="mtgImage">
	</div>-->
	<p>
		<span><?php echo $data['type'] ?></span>
		<span>M13</span>
	</p>
	<p><?php echo $data['text'] ?></p>
	<p><?php
        if (isset($data['power'])) {
            echo $data['power'] . '/' . $data['toughness'];
        } elseif (isset($data['loyalty'])) {
            echo $data['loyalty'];
        }
        ?></p>
</article>